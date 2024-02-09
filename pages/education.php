<?php
include("header.php");
?>
 
  <div class="container">
    <div class="row" id="newsList"></div>
  </div>

  <!-- Bootstrap JS and your script -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
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
  const newsList = document.getElementById('newsList');

  articles.forEach(article => {
    // Check if the article title or description contains education-related keywords
    const isEducationNews =
      article.title.toLowerCase().includes('education') ||
      article.description.toLowerCase().includes('education') ||
      article.title.toLowerCase().includes('school') ||
      article.description.toLowerCase().includes('school') ||
      article.title.toLowerCase().includes('learning') ||
      article.description.toLowerCase().includes('learning');

    // If the article is related to education, display it
    if (isEducationNews) {
      const col = document.createElement('div');
      col.classList.add('col-lg-4', 'mb-4');

      const card = document.createElement('div');
      card.classList.add('card');

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
    }
  });
}

    // Fetch news when the page loads
    window.onload = fetchNews;
  </script>
</body>

</html>
