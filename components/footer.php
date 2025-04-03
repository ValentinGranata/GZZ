<style>
    footer {
        width: calc(100% - 20px * 2);

        padding: 20px;

        background: black;
        background-position: center;
        background-size: cover;
    }

    footer .inside {
        width: calc(100% - 40px * 2);
        padding: 40px;

        display: flex;
        justify-content: space-between;
        flex-wrap: wrap;
    }

    footer .inside .column {
        min-width: 200px;
        
        padding: 10px;
        flex: 1;
    }

    footer .inside .column h1 {
        color: #6C63FF;
        font-size: 20px;
        
        padding: 20px 0;
    }

    footer .inside .column p {
        color: whitesmoke;
        font-size: 16px;
        padding: 5px 0;
    }
</style>

<footer>
    <div class="inside glass">
        <div class="column">
            <h1>Team</h1>

            <p>Valentin Granata</p>
            <p>Davide Zanzon</p>
            <p>Emanuele Zingarelli</p>
        </div>

        <div class="column">
            <h1>Languages</h1>

            <p>HTML</p>
            <p>CSS</p>
            <p>JavaScript</p>
            <p>SQL</p>
            <p>PHP</p>
        </div>

        <div class="column">
            <h1>Tools</h4>

            <p>XAMP</p>
            <p>VSCode</p>
            <p>MySQL</p>
        </div>

        <div class="column">
            <h1>Contact</h4>

            <p>info@gzz.com</p>
        </div>
    </div>
</footer>