<?php

/**
*The page wich displays loop wiew
*/

get_header();
?>

<!--I vores primary section, har vi al indhold som det skal skrives ud på siden med episoder single view. -->
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
    // I scriptet til vores episoder single view, har vi startet med at sætte variabler, der skal bruges i senere funktioner.
    let episode;
    let aktuelepisode = <?php echo get_the_ID() ?>;
    console.log("episode:", aktuelepisode);

    //Nedenstående variabel skal vi bruge, når vi indhenter json med episoder. Via dette link kan vi se alle vores episode custom posts.
    const episodeUrl = "https://neanderpetersen.dk/kea/09_cms/radioloud/wp-json/wp/v2/episoder/" + aktuelepisode;

    //I vores asynkrone funktion, sætter vi først en variabel, der definerer at der skal afventes med afhentningen af indholdet fra vores url-variabel. Derefter beder vi om at aktivere visEpisoder(), der sørger for at vores episoder skal vises på siden når al json er hentet ind fra vores url-variabel.
    async function getJson() {
        const data = await fetch(episodeUrl);
        episode = await data.json();
        console.log("episoder:", episode);

        visEpisoder();
    }

    //Denne funktion udskriver al vores json på vores site, når al indholdet er afhentet. Vi tilføjer her content til vores HTML-struktur.
    function visEpisoder() {
        console.log("visPodcasts");
        document.querySelector(".titel").textContent = episode.title.rendered;
        document.querySelector(".txt").textContent = episode.episodenr;
        document.querySelector(".billede").src = episode.billede.guid;
        document.querySelector("#beskrivelse").textContent = episode.episodebeskrivelse;

    }

    tilbageKnap();

    //Denne funktion gør vores tilbage-knap klikbar, og aktiverer visTilbage(), der fortæller at man skal tilbage til den side man lige er kommet fra.
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
