let shownStartups = [];

async function loadRandomStartup(type) {
    return fetch('/projects/gzz/data/post/load_post.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
        body: new URLSearchParams({
            type,
            shown: JSON.stringify(shownStartups)
        })
    })
    .then(response => response.json())
    .then(data => {
        if (data.reset) {
            shownStartups = [];
            loadRandomStartup();
        } else {
            console.log(data);
            shownStartups.push(data.id);
        }

        return data;
    })
    .catch(error => console.log(error));
}