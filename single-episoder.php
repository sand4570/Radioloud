<?php

/**
*The page wich displays loop wiew
*/

get_header();
?>

<section id="primary" class="content-area">
    <main id="main" class="site-main">

        <button class="singletilbage">Tilbage</button>

        <article class="singleepisode">
            <div>
                <h2 class="titel"></h2>
                <p class="txt"></p>
                <p id="beskrivelse"></p>
                <div class="ikoner">
                    <a href="https://open.spotify.com/" target=”_blank”>
                        <img src="https://neanderpetersen.dk/kea/09_cms/radioloud/wp-content/uploads/2021/04/download.png" alt="Spotify-ikon">
                    </a>
                    <a href="">
                        <img src="https://neanderpetersen.dk/kea/09_cms/radioloud/wp-content/uploads/2021/04/download-kopi.png" alt="Afspil-knap">
                    </a>
                </div>
            </div>
            <div>
                <img src="" alt="" class="billede">
            </div>
        </article>
    </main>
</section>


<script>
    let episode;
    let aktuelepisode = <?php echo get_the_ID() ?>;
    console.log("episode:", aktuelepisode);

    const episodeUrl = "https://neanderpetersen.dk/kea/09_cms/radioloud/wp-json/wp/v2/episoder/" + aktuelepisode;


    async function getJson() {
        const data = await fetch(episodeUrl);
        episode = await data.json();
        console.log("episoder:", episode);

        visEpisoder();
    }

    function visEpisoder() {
        console.log("visPodcasts");
        document.querySelector(".titel").textContent = episode.title.rendered;
        document.querySelector(".txt").textContent = episode.episodenr;
        document.querySelector(".billede").src = episode.billede.guid;
        document.querySelector("#beskrivelse").textContent = episode.episodebeskrivelse;

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
