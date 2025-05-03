const PARAMS = new URLSearchParams(window.location.search);

const btns = ["random", "repost", "save", "like"];

const switchType = (type) => {
    btns.forEach((btn) => {
        const btnElement = document.getElementById(`${btn}-btn`);
        if (!btnElement) return;

        btnElement.classList.remove('active');
    });

    document.getElementById(`${type}-btn`).classList.add('active');
}

window.onload = () => {
    const type = PARAMS.get('type');
    
    switchType(type);
}

const save = document.getElementById("save");
const repost = document.getElementById("repost");
const like = document.getElementById("like");

const interactionBtns = [save, repost, like];

interactionBtns.forEach((btn) => {
    btn.onclick = (e) => {
        e.preventDefault();

        btn.classList.toggle('active');
        const h1 = btn.children[1];

        if (h1) {
            h1.innerText = parseInt(h1.innerText) + (btn.classList.contains('active') ? 1 : -1);
        }

        const btnType = btn.id;
        const startupID = PARAMS.get('startup_id');

        addInteraction(startupID, btnType);
    }
});

function addInteraction(startupID, type) {
    fetch(`http://localhost/projects/gzz/data/interaction/add_interaction.php`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({ 
            "startup_id": startupID,
            "type": type
        })
    })
    .then(response => response.json())
    .then(data => {
        console.log(data);
    })
}

const filter = document.getElementById("filter");
const deleteForm = document.getElementById("delete-form");

function toggleDelete() {
    filter.classList.toggle('hidden');
    deleteForm.classList.toggle('hidden');
}