var superLink = function() {

    document.querySelectorAll(".JixinParser-card .JixinParser-card-meta span.fold").forEach(function(element) {
        element.addEventListener("click", function() {
            var parentNext = this.parentElement.nextElementSibling;
            if (parentNext.children.length > 0) {
                parentNext.innerHTML = '';
            } else {
                parentNext.innerHTML = '<iframe src="'+ this.parentElement.parentElement.getAttribute('data-src') +'" scrolling="no" border="0" frameborder="no" framespacing="0" allowfullscreen="true"> </iframe>';
            }
        });
    });

    document.querySelectorAll('.JixinParser-card.github .iframe-container').forEach(function(container) {
    
        var url = container.parentElement.getAttribute('data-src');
    
        fetch(url)
            .then(response => {
                if (!response.ok) {
                    container.innerHTML = `HTTP error! Status: ${response.status}`;
                    throw new Error(`HTTP error! Status: ${response.status}`);
                }
                return response.json();
            })
            .then(data => {
                container.innerHTML = `${data.description != null ? data.description : ""}<br>
                                                ${data.homepage != null ? data.homepage : ""}<br><br>
                                                <span style="color:#666">Star: ${data.stargazers_count}</span>&nbsp;&nbsp;
                                                <span style="color:#666">Fork: ${data.forks_count}</span>&nbsp;&nbsp;
                                                <span style="color:#666">Lang: ${data.language}</span>&nbsp;&nbsp;
                                                <span style="color:#666">Branch: ${data.default_branch}</span>&nbsp;&nbsp;
                                                `;
            })
            .catch(error => {
                container.innerHTML = error.message ? error.message : "Fetch Request Failed!";
            });
    });

};

window.onload = function() {
    superLink();
}
