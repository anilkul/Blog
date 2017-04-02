<?php
function insertCategories()
{
    global $con;
    if (isset($_POST['submit'])) {
        $cat_title = $_POST['cat_title'];
                                //bir veri girilmedi ise veya bosluk girildi ise
        if ($cat_title == "" || empty($cat_title)) {
            echo "This field should not be empty";
        } else {
            $query = "INSERT INTO categories(cat_title) VALUES ('$cat_title')";
            $createCategoryQuery = mysqli_query($con, $query);

            if (!$createCategoryQuery) {
                die('QUERY FAILED!' . mysqli_error($con));
            }
        }
    }
}


function deleteCategory()
{
	global $con;
    if (isset($_GET['delete'])) { //url'de tanimladigimiz superglobal delete degerini sanity check yapiyoruz
    	$cat_id = $_GET['delete']; // yeni cat_id degerimiz silinmesini istedigimiz kategorinin id'si
    	$query = "DELETE FROM categories WHERE cat_id = $cat_id"; // query yarattik
    	$delete_query = mysqli_query($con, $query); //query'yi yolladik

    	header("Location: categories.php"); //Bu komut sayfayi yenilememizi saglar. Bunu yapmazsak 2 kere delete'ye basmak zorunda kaliriz cunku ilk seferde delte degeri superglobala atanir ikincisinde uygulanir.
	}
}


function createCategoryTable()
{
	global $con;
	$query = "SELECT * FROM categories"; // query yarat
		$selectCategories = mysqli_query($con, $query); //query'yi yolla
		while ($row = mysqli_fetch_assoc($selectCategories)) {  //yollanan query'yi associcative array seklinde tanimla
		    extract($row); // assoc array seklinde tanimlanan query'yi $key = value; formatina donustur.

		    echo "<tr>";
		    echo "<td>" . $cat_title . "</td>";
		    echo "<td><a href='categories.php?delete={$cat_id}'> Delete </a></td>";// ? ile delete kismini GET ile cekilebilecek sekilde superglobal olarak tanimladik.
		    echo "<td><a href='categories.php?edit={$cat_id}'> Edit </a></td>";
		    echo "</tr>";
		}
}

