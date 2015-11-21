<?php
require_once __DIR__ . '/vendor/autoload.php';

$guzzle  = new \GuzzleHttp\Client;
$crawler = new \Symfony\Component\DomCrawler\Crawler;

$fetcher = new \Darsyn\MovieFetcher\MovieFetcher($guzzle, $crawler);
$fetcher->addParser(new \Darsyn\MovieFetcher\Parser\ImdbParser);
$fetcher->addParser(new \Darsyn\MovieFetcher\Parser\RottenTomatoesParser);
?>
<!DOCTYPE html>
<html>

<head>
    <title>Movie Fetcher</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css" rel="stylesheet" integrity="sha256-MfvZlkHCEqatNoGiOXveE8FIwMzZg4W85qfrfIFBfYc= sha512-dTfge/zgoMYpP7QbHy4gWMEGsbsdZeCXz7irItjcC3sPUFtf0kuFbDz/ixG7ArTxmDjLXDmezHubeNikyKGVyQ==" crossorigin="anonymous">
</head>

<body>
<div class="container">
    <p>&nbsp;</p>
    <form action="?" method="post">
        <div class="form-group">
            <label for="url">Movie URL</label>
            <input type="text" class="form-control" id="url" name="url" placeholder="http://">
        </div>
        <button type="submit" class="btn btn-default">Fetch Movie Details</button>
    </form>

    <?php if (isset($_POST['url']) && !empty($_POST['url'])): ?>
        <?php
        $movie = $fetcher->fetch($_POST['url']);
        ?>
        <hr />
        <table class="table">
            <tr>
                <td>Title</td>
                <td><?= $movie->getTitle(); ?></td>
            </tr>
            <tr>
                <td>Year of Release</td>
                <td><?= $movie->getYearOfRelease(); ?></td>
            </tr>
            <tr>
                <td>Rating</td>
                <td><?= $movie->getRating(); ?>%</td>
            </tr>
            <tr>
                <td>Genres</td>
                <td><?= implode(', ', $movie->getGenres()); ?></td>
            </tr>
            <tr>
                <td>Summary</td>
                <td><?= $movie->getSummary(); ?></td>
            </tr>
        </table>
    <?php endif; ?>
</div>
</body>

</html>
