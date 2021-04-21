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
            <div class="singlebillede">

                <h2 class="titel"></h2>
                <h3 class="underoverskrift"></h3>
                <p></p>
            </div>
        </article>

    </main>
</section>

<script>
    let podcast;

    const dbUrl = "https://neanderpetersen.dk/kea/09_cms/radioloud/wp-json/wp/v2/podcast/" + <?php echo get_the_ID() ?>;

    async function getJson() {
        console.log("getJson");
        const data = await fetch(dbUrl);
        rute = await data.json();
        visPodcasts();
    }

    function visPodcasts() {
        console.log("visPodcasts");
        document.querySelector(".titel").textContent = podcast.title.rendered;
        document.querySelector("p").textContent = podcast.langbeskrivelse;
        document.querySelector(".underoverskrift").textContent = podcast.title.rendered;
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
