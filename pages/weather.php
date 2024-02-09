<?php
include("header.php");
?>
<div class="container pt-3">
    <div class="row">
        <div class="col-lg-12 col-md-6">
            <div class="card shadow-xs border">
                <div class="card-header border-bottom pb-0">
                    <div class="d-sm-flex align-items-center mb-3">

                        <div class="pb-3 d-sm-flex align-items-center">
                            <div class="row" class="weanews"></div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div><script>
// Function to fetch news from NewsAPI
 function fetchNews() {
  const apiKey = 'ed4ff1093860439ab02bf6bb1a49901b'; // Replace 'YOUR_NEWSAPI_KEY' with your actual NewsAPI key
  const apiUrl = `https://newsapi.org/v2/top-headlines?country=ng&apiKey=${apiKey}`;

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

// Function to display news on the webpage
function displayNews(articles) {
  const newsList = document.getElementById('weanews');

  articles.forEach(article => {
    const col = document.createElement('div');
    col.classList.add('col-lg-6', 'mb-4');

    const card = document.createElement('div');
    card.classList.add('card', 'h-100');

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