<?php
require_once __DIR__ . '/vendor/autoload.php';
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

$api_key = getenv("GOOGLE_API_KEY");

if (isset($_POST['search'])) {
    $search_query = '"' . strtolower($_POST['search']) . '"';
    $api_url = "https://www.googleapis.com/books/v1/volumes?q=intitle:" . urlencode($search_query) . "&maxResults=5&key=" . $api_key;
    
    $response = file_get_contents($api_url);
    $books_data = json_decode($response, true);

    if (isset($books_data['items'])) {
        foreach ($books_data['items'] as $book) {
            $title = $book['volumeInfo']['title'];
            $thumbnail = isset($book['volumeInfo']['imageLinks']['thumbnail']) ? $book['volumeInfo']['imageLinks']['thumbnail'] : 'No image available';
            $price = rand(900, 3000);
            $code = $book['id'];
?>
<div class='bks'>
    <form action="" method="post" class='box'>
        <img src='<?php echo htmlspecialchars($thumbnail); ?>' alt='<?php echo htmlspecialchars($title); ?>' class='bimage'>
        <div class='title'><?php echo htmlspecialchars($title); ?></div>
        <div class='price'>₹<?php echo htmlspecialchars($price); ?></div>
        <input type='number' class='bkqty' name='bkqty' min='1' max='5' value='1'>
        <input type='hidden' name='bkcode' value='<?php echo htmlspecialchars($code); ?>'>
        <input type='hidden' name='bktitle' value='<?php echo htmlspecialchars($title); ?>'>
        <input type='hidden' name='bkprice' value='<?php echo htmlspecialchars($price); ?>'>
        <input type='hidden' name='bkimage' value='<?php echo htmlspecialchars($thumbnail); ?>'>
        <input type='submit' class='button' value='Add To Cart' name='add_to_cart'>
    </form>
</div>
<?php
        }
    } else {
        echo '<p class="empty" style="color:red;">No Books Found!</p>';
    }
}
?>