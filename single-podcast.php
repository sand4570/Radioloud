<?php 

/**
*The page wich displays loop wiew
*/

get_header();
?>

<section id="primary" class="content-area">
    <main id="main" class="site-main">

        <button class="singletilbage">Tilbage</button>
        <article class="singlearticle">
            <h2 class="titel"></h2>
            <a href="https://open.spotify.com/" target=”_blank”>
                <img src="images/download.png" alt="Spotify-ikon">
            </a>
            <a href="">
                <img src="images/download-kopi.png" alt="Afspil-knap">
            </a>
            <p class="txt"></p>
            <img src="" alt="" class="billede">
        </article>

        <section id="episoder">
            <template>
                <article>
                    <img src="" alt="">
                    <h3></h3>
                    <p class="beskrivelse"></p>
                    <button class="button">Læs mere</button>
                </article>
            </template>
        </section>

    </main>
</section>


<script>
    let podcast;

    const dbUrl = "https://neanderpetersen.dk/kea/09_cms/radioloud/wp-json/wp/v2/podcast/" + <?php echo get_the_ID() ?>;

    async function getJson() {
        console.log("getJson");
        const data = await fetch(dbUrl);
        podcast = await data.json();
        visPodcasts();
    }

    function visPodcasts() {
        console.log("visPodcasts");
        document.querySelector(".titel").textContent = podcast.title.rendered;
        document.querySelector(".txt").textContent = podcast.beskrivelse;
        document.querySelector(".billede").src = podcast.billede.guid;

    }

    tilbageKnap();

    function tilbageKnap() {
        document.querySelector(".singletilbage").addEventListener("click", visTilbage);
    }

    function visTilbage() {
        window.history.back();
    }

    getJson();

</script>

<?php
get_footer();
