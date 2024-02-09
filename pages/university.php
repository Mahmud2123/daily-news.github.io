<?php
include("header.php");
?>
<!-- <div class="container pt-3">
    <div class="row">
        <div class="col-lg-12 col-md-6">
            <div class="card shadow-xs border">
                <div class="card-header border-bottom pb-0">
                    <div class="d-sm-flex align-items-center mb-3">

                        <div class="pb-3 d-sm-flex align-items-center">
                            <div class="row" class="uninews"></div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div> -->
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <title>News Display</title>
</head>

<body>
  <div class="container">
    <div class="row" id="newsList"></div>
  </div>

  <script>
    function fetchNews() {
      const apiKey = 'ed4ff1093860439ab02bf6bb1a49901b'; // Replace with your NewsAPI key
      const apiUrl = `https://newsapi.org/v2/top-headlines?country=us&apiKey=${apiKey}`;

      fetch(apiUrl)
        .then(response => {
          if (!response.ok) {
            throw new Error('Network response was not ok.');
          }
          return response.json();
        })
        .then(data => {
          displayNews(data.articles);
        })
        .catch(error => {
          console.error('There has been a problem with your fetch operation:', error);
        });
    }

    function displayNews(articles) {
      const newsList = document.getElementById('technews');

      articles.forEach(article => {
        const col = document.createElement('div');
        col.classList.add('col-lg-4', 'mb-4'); // Bootstrap column size

        const card = document.createElement('div');
        card.classList.add('card');

        const image = document.createElement('img');
        image.src = article.urlToImage ? article.urlToImage : 'https://via.placeholder.com/300';
        image.alt = 'News Image';
        image.classList.add('card-img-top');

        const cardBody = document.createElement('div');
        cardBody.classList.add('card-body');

        const link = document.createElement('a');
        link.href = article.url;
        link.textContent = article.title;
        link.classList.add('card-title', 'text-decoration-none', 'fw-bold', 'text-dark');

        const description = document.createElement('p');
        description.textContent = article.description ? article.description : 'No description available.';
        description.classList.add('card-text');

        cardBody.appendChild(link);
        cardBody.appendChild(description);

        card.appendChild(image);
        card.appendChild(cardBody);

        col.appendChild(card);

        newsList.appendChild(col);
      });
    }

    // Fetch news when the page loads
    window.onload = fetchNews;
  </script>