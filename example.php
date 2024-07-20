<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book Carousel</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div id="bookCarousel" class="carousel slide" data-ride="carousel">
    <div class="carousel-inner">
        <?php foreach($books as $index => $book): ?>
            <div class="carousel-item <?php echo $index === 0 ? 'active' : ''; ?>">
                <div class="card" style="width: 18rem; margin: auto;">
                    <img src="<?php echo $book['image_url']; ?>" class="card-img-top" alt="Book Image">
                    <div class="card-body">
                        <h5 class="card-title"><?php echo $book['title']; ?></h5>
                        <p class="card-text">by <?php echo $book['author']; ?></p>
                        <p class="card-text">Rating: <?php echo $book['rating']; ?> / 5</p>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
    <a class="carousel-control-prev" href="#bookCarousel" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#bookCarousel" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
    </a>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
