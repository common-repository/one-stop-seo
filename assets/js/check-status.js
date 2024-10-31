function checksitemap() {
    
    fetch('https://fahadbinzafar.com/sitemap_index.xml')
    .then(response => {
      alert(response.status);
      console.log(response);
    })
    .catch(err => {
      console.log(err);
    });
    
    
}


var cells = document.getElementById("table").getElementsByTagName("td");
for (var i = 0; i < cells.length; i++) {
    if (cells[i].innerHTML == "200") {
        cells[i].style.backgroundColor = "#009879";
        cells[i].style.color = "white";
    }
    else if (cells[i].innerHTML == "301") {
        cells[i].style.color = "#d57272";
    }
    else if (cells[i].innerHTML == "Available") {
        cells[i].style.color = "#009879";
    }
    
}