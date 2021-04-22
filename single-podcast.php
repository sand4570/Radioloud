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
                <img src="wp-content/themes/radioloud/images/download.png" alt="Spotify-ikon">
            </a>
            <a href="">
                <img src="wp-content/themes/radioloud/images/download-kopi.png" alt="Afspil-knap">
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
            if (episode.horer_til_podcast == aktuelpodcast) {
                console.log("loop kører id:", aktuelpodcast);
                let klon = temp.cloneNode(true).content;
                klon.querySelector("h2").textContent = episode.title.rendered;
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
