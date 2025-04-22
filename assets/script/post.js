const randomBtn = document.getElementById("random-btn");
const repostsBtn = document.getElementById("reposts-btn");
const savedBtn = document.getElementById("saved-btn");
const likedBtn = document.getElementById("liked-btn");

let type = "random";

function firstUp(string) {
    return string.charAt(0).toUpperCase() + string.slice(1);
}

const switchType = (e, type) => {
    e.preventDefault();

    randomBtn.classList.remove('active');
    repostsBtn.classList.remove('active');
    savedBtn.classList.remove('active');
    likedBtn.classList.remove('active');
    e.target.classList.add('active');

    type = this.type;

    loadRandomStartup(type)
        .then(startup => renderStartup(startup));
}

randomBtn.onclick = (e) => switchType(e, "random");
repostsBtn.onclick = (e) => switchType(e, "repost");
savedBtn.onclick = (e) => switchType(e, "saved");
likedBtn.onclick = (e) => switchType(e, "liked");

const startupName = document.getElementById("startup-name");
const startupDescription = document.getElementById("startup-description");
const startupOwner = document.getElementById("startup-owner");
const startupBanner = document.getElementById("startup-banner");
const ownerProfilePpicture = document.getElementById("owner-profile-picture");

window.onload = (e) => {
    e.preventDefault();

    loadRandomStartup(type)
        .then(startup => renderStartup(startup));
};

function renderStartup(startup) {
    console.log("path : /projects/gzz/uploads/")

    startupName.innerText = startup.title + " - " + startup.created_at;
    startupDescription.innerText = startup.description;
    startupOwner.innerHTML = firstUp(startup.name) + " " + firstUp(startup.surname);
    startupBanner.src = "/projects/gzz/uploads/" + startup.banner;
    ownerProfilePpicture.src = "/projects/gzz/uploads/" + startup.profile_picture;
}