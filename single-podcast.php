<?php 

/**
*The page wich displays loop wiew
*/

get_header();
?>
<!--I vores primary section, har vi al indhold som det skal skrives ud på siden med podcast single view. -->
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
                <img src="" alt="" class="billede" id="bigimg">
            </div>
        </article>
        <img id="pil" src="https://neanderpetersen.dk/kea/09_cms/radioloud/wp-content/uploads/2021/04/pil.svg" alt="pil">

        <h3>Episoder</h3>
        <section id="episoder"></section>

    </main>
</section>

<!--I nedenstående template-tag, findes strukturen for hvordan hver enkel episode i loop viewet på single viewet for podcasts skal være opbygget og struktureret. -->
<template>
    <article>
        <img src="" alt="">
        <h3></h3>
        <p class="beskrivelse"></p>
        <button class="button">Læs mere</button>
    </article>
</template>

<!-- I scriptet til vores episoder single view, har vi startet med at sætte variabler, der skal bruges i senere funktioner.-->
<script>
    let podcast;
    let episoder;
    let aktuelpodcast = <?php echo get_the_ID() ?>;


    //Nedenstående variabler skal vi bruge, når vi indhenter al json. Via disse links kan vi både se alle vores podcast- og episode custom posts
    const dbUrl = "https://neanderpetersen.dk/kea/09_cms/radioloud/wp-json/wp/v2/podcast/" + aktuelpodcast;
    const episodeUrl = "https://neanderpetersen.dk/kea/09_cms/radioloud/wp-json/wp/v2/episoder?per_page=100";

    const container = document.querySelector("#episoder")

    //I vores asynkrone funktion, sætter vi to variabler, der definerer at der skal afventes med afhentningen af indholdet fra vores url-variabler. Derefter beder vi om at aktivere visPodcasts() og visEpisoder(), der sørger for at vores podcasts og episoder skal vises på siden når al json er hentet ind fra vores url-variabler.
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

    //Denne funktion udskriver al podcast json på vores site, når al indholdet er afhentet. Vi tilføjer her content til vores HTML-struktur.
    function visPodcasts() {
        console.log("visPodcasts");
        document.querySelector(".titel").textContent = podcast.title.rendered;
        document.querySelector(".txt").textContent = podcast.beskrivelse;
        document.querySelector(".billede").src = podcast.billede.guid;

    }

    //Denne funktion udskriver al episode json på vores site, når al indholdet er afhentet. Vi tilføjer her content til vores template-tag, som vi kloner ud i sektionen i vores main-tag. For-each-funktionen gør, at dette sker for hver episode vi har oprettet.
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
