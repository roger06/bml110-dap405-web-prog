
var url = 'https://newsapi.org/v2/top-headlines?' +
          'country=us&' +
          'apiKey=192689c299de4ea59d9dd865d8ecb138';
var req = new Request(url);
fetch(req)
    .then(function(response) {
        console.log(response.json());
    })