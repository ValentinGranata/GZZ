const randomBtn = document.getElementById("random-btn");
const repostsBtn = document.getElementById("reposts-btn");
const savedBtn = document.getElementById("saved-btn");
const likedBtn = document.getElementById("liked-btn");

let type = "random";

const switchType = (e, type) => {
    e.preventDefault();

    randomBtn.classList.remove('active');
    repostsBtn.classList.remove('active');
    savedBtn.classList.remove('active');
    likedBtn.classList.remove('active');
    e.target.classList.add('active');

    type = this.type;

    loadRandomStartup(type)
        .then(renderStartup);
}

randomBtn.onclick = (e) => switchType(e, "random");
repostsBtn.onclick = (e) => switchType(e, "repost");
savedBtn.onclick = (e) => switchType(e, "saved");
likedBtn.onclick = (e) => switchType(e, "liked");

const startupName = document.getElementById("startup-name");
const startupDescription = document.getElementById("startup-description");
const startupOwner = document.getElementById("startup-owner");

window.onload = (e) => {
    e.preventDefault();

    loadRandomStartup(type)
        .then(renderStartup);
};

function renderStartup(startup) {
    startupName.innerText = startup.title + " - " + startup.created_at;
    startupDescription.innerText = startup.description;
    startupOwner.innerHTML = startup.name + " " + startup.surname;
}