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
            <div>
                <h2 class="titel"></h2>

                <p class="txt"></p>
                <div class="ikoner">
                    <a href="https://open.spotify.com/" target=”_blank”>
                        <img src="https://neanderpetersen.dk/kea/09_cms/radioloud/wp-content/uploads/2021/04/download.png" alt="Spotify-ikon">
                    </a>
                    <a href="">
                        <img class="afspilknap" src="https://neanderpetersen.dk/kea/09_cms/radioloud/wp-content/uploads/2021/04/download-kopi.png" alt="Afspil-knap">
                    </a>
                </div>
            </div>
            <div>
                <img src="" alt="" class="billede">
            </div>
        </article>
        <img id="pil" src="https://neanderpetersen.dk/kea/09_cms/radioloud/wp-content/uploads/2021/04/pil.svg" alt="pil">

        <h3>Episoder</h3>
        <section id="episoder"></section>

    </main>
</section>

<template>
    <article>
        <img src="" alt="">
        <h3></h3>
        <p class="beskrivelse"></p>
        <button class="button">Læs mere</button>
    </article>
</template>


<script>
    let podcast;
    let episoder;
    let aktuelpodcast = <?php echo get_the_ID() ?>;

    const dbUrl = "https://neanderpetersen.dk/kea/09_cms/radioloud/wp-json/wp/v2/podcast/" + aktuelpodcast;
    const episodeUrl = "https://neanderpetersen.dk/kea/09_cms/radioloud/wp-json/wp/v2/episoder?per_page=100";

    const container = document.querySelector("#episoder")

    async function getJson() {
        console.log("getJson");
        const data = await fetch(dbUrl);
        podcast = await data.json();

        const data2 = await fetch(episodeUrl);
        episoder = await data2.json();
        console.log("episoder:", episoder);

        visPodcasts();
        visEpisoder();
    }

    function visPodcasts() {
        console.log("visPodcasts");
        document.querySelector(".titel").textContent = podcast.title.rendered;
        document.querySelector(".txt").textContent = podcast.beskrivelse;
        document.querySelector(".billede").src = podcast.billede.guid;

    }

    function visEpisoder() {
        console.log("viserEpisoderne");
        let temp = document.querySelector("template");
        episoder.forEach(episode => {
            console.log("loop id:", aktuelpodcast);
            if (episode.horer_til_podcast[0].id == aktuelpodcast) {
                console.log("loop kører id:", aktuelpodcast);
                let klon = temp.cloneNode(true).content;
                klon.querySelector("h3").innerHTML = episode.title.rendered;
                klon.querySelector("img").src = episode.billede.guid;
                klon.querySelector(".beskrivelse").innerHTML = episode.episodenr;

                klon.querySelector("article").addEventListener("click", () => {
                    location.href = episode.link;
                })

                klon.querySelector("button").href = episode.link;
                console.log("episode", episode.link);
                container.appendChild(klon);
            }
        })
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
