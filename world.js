window.addEventListener('load', function(){
    let searchButton = document.getElementById('search');

  var httpRequest;

  searchButton.addEventListener('click', function(element) {
    element.preventDefault();

    httpRequest = new XMLHttpRequest();

    // GET Request
    var url = "http://localhost/info2180-lab5/world.php?query=${formData}";
    httpRequest.onreadystatechange = loadSearch;
    httpRequest.open('GET', url);
    httpRequest.send();
  });

  function loadSearch() {
    if (httpRequest.readyState === XMLHttpRequest.DONE) {
      if (httpRequest.status === 200) {
        var response = httpRequest.responseText;
        var search = document.querySelector('#search');
        search.innerHTML = response;
      } else {
        alert('There was a problem with the request.');
      }
    }
  }

});
