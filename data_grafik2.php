<?php
session_start(); // Memulai session
// Memeriksa apakah pengguna telah login
if (!isset($_SESSION['username'])) {
    header("Location: index.php"); // Mengarahkan pengguna ke halaman login jika belum login
    exit();
}
include 'koneksi.php';
include 'data_header.php';
include 'sidebar.php';
include 'topbar.php';

//query untuk tahu SUM(Amount) semuanya
$sql = "SELECT sum(OrderQTY) as tot from salespercustfact";
$tot = mysqli_query($koneksi, $sql);
$tot_amount = mysqli_fetch_row($tot);

// echo $tot_amount[0];

//query untuk ambil penjualan berdasarkan kategori, query sudah dimodifikasi
//ditambahkan label variabel DATA. (teknik gak jelas :D)

$sql = "SELECT concat('name:',p.Name) as name, concat('y:', sum(spcf.OrderQTY)*100/" . $tot_amount[0] . ") as y, concat('drilldown:', p.Name) as drilldown
            FROM salespercustfact AS spcf
            JOIN product p ON p.ProductID = spcf.ProductID
            GROUP BY p.Name
            ORDER BY y DESC";
// echo $sql;
$all_kat = mysqli_query($koneksi, $sql);
if ($all_kat === false) {
    // Display the error message
    echo "Error: " . mysqli_error($koneksi);
} else {
    while ($row = mysqli_fetch_all($all_kat)) {
        $data[] = $row;
    }
}


$json_all_kat = json_encode($data);

// echo $json_all_kat;
// CHART KEDUA (DRILL DOWN)

// query untuk tahu SUM(Amount) semua kategori
$sql = "SELECT p.Name name, sum(spcf.OrderQTY) as tot_kat
            FROM salespercustfact spcf
            JOIN product p ON (p.ProductID = spcf.ProductID)
            GROUP BY name
            ORDER BY tot_kat";
$hasil_kat = mysqli_query($koneksi, $sql);

while ($row = mysqli_fetch_all($hasil_kat)) {
    $tot_all_kat[] = $row;
}

//print_r($tot_all_kat);
//function untuk nyari total_per_kat 

//echo count($tot_per_kat[0]);
//echo $tot_per_kat[0][0][1];

function cari_tot_kat($kat_dicari, $tot_all_kat)
{
    $counter = 0;
    // echo $tot_all_kat[0];
    while ($counter < count($tot_all_kat[0])) {
        if ($kat_dicari == $tot_all_kat[0][$counter][0]) {
            $tot_kat = $tot_all_kat[0][$counter][1];
            return $tot_kat;
        }
        $counter++;
    }
}

//query untuk ambil penjualan di kategori berdasarkan contact (clean)
$sql = "SELECT p.Name as name,
            c.FirstName as firstname, 
            sum(spcf.OrderQTY) as pendapatan_kat
            FROM product p
            JOIN salespercustfact spcf ON (p.ProductID = spcf.ProductID)
            JOIN contact c ON (c.ContactID = spcf.ContactID)
            GROUP BY name, firstname";
$det_kat = mysqli_query($koneksi, $sql);
$i = 0;
while ($row = mysqli_fetch_all($det_kat)) {
    //echo $row;
    $data_det[] = $row;
}

//print_r($data_det);

//PERSIAPAN DATA DRILL DOWN - TEKNIK CLEAN  
$i = 0;

//inisiasi string DATA
$string_data = "";
$string_data .= '{name:"' . $data_det[0][$i][0] . '", id:"' . $data_det[0][$i][0] . '", data: [';


// echo cari_tot_kat("Action", $tot_all_kat);
foreach ($data_det[0] as $a) {
    //echo cari_tot_kat($a[0], $tot_all_kat);

    if ($i < count($data_det[0]) - 1) {
        if ($a[0] != $data_det[0][$i + 1][0]) {
            $string_data .= '["' . $a[1] . '", ' .
                $a[2] * 100 / cari_tot_kat($a[0], $tot_all_kat) . ']]},';
            $string_data .= '{name:"' . $a[0] . '", id:"' . $a[0]    . '", data: [';
        } else {
            $string_data .= '["' . $a[1] . '", ' .
                $a[2] * 100 / cari_tot_kat($a[0], $tot_all_kat) . '], ';
        }
    } else {

        $string_data .= '["' . $a[1] . '", ' .
            $a[2] * 100 / cari_tot_kat($a[0], $tot_all_kat) . ']]}';
    }


    $i = $i + 1;
}

?>
<div id="content">
    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-4 text-gray-800">Grafik Sales by Product</h1>
        </div>


        <!-- Content Row -->
        <div class="row">

            <div class="col-lg-12 mb-4">

                <!-- Illustrations -->
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary"></h6>
                    </div>
                    <div class="card-body">
                        <figure class="highcharts-figure">
                            <div id="container"></div>
                            <p class="highcharts-description">

                            </p>
                        </figure>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <!-- /.container-fluid -->

</div>
</div>

<script type="text/javascript">
    // Create the chart
    Highcharts.chart('container', {
        chart: {
            type: 'pie'
        },
        title: {
            text: 'Sales by Product'
        },
        subtitle: {
            text: 'Click a slice to see customer who purchased'
        },

        accessibility: {
            announceNewData: {
                enabled: true
            },
            point: {
                valueSuffix: '%'
            }
        },

        plotOptions: {
            series: {
                dataLabels: {
                    enabled: true,
                    format: '{point.name}: {point.y:.1f}%'
                }
            }
        },

        tooltip: {
            headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
            pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y:.2f}%</b> of total<br/>'
        },

        series: [{
            name: "Sold product",
            colorByPoint: true,
            data: <?php
                    //TEKNIK GAK JELAS :D

                    $datanya =  $json_all_kat;
                    $data1 = str_replace('["', '{"', $datanya);
                    $data2 = str_replace('"]', '"}', $data1);
                    $data3 = str_replace('[[', '[', $data2);
                    $data4 = str_replace(']]', ']', $data3);
                    $data5 = str_replace(':', '" : "', $data4);
                    $data6 = str_replace('"name"', 'name', $data5);
                    $data7 = str_replace('"drilldown"', 'drilldown', $data6);
                    $data8 = str_replace('"y"', 'y', $data7);
                    $data9 = str_replace('",', ',', $data8);
                    $data10 = str_replace(',y', '",y', $data9);
                    $data11 = str_replace(',y : "', ',y : ', $data10);
                    echo $data11;
                    ?>

        }],
        drilldown: {
            series: [

                <?php
                //TEKNIK CLEAN
                echo $string_data;

                ?>



            ]
        }
    });
</script>
<?php
include 'data_footer.php';
?>