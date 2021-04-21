<?php 

/**
*The page wich displays loop wiew
*/

get_header();
?>

<section id="primary" class="content-area">
    <main id="main" class="site-main">

        <h1>Podcasts</h1>
        <nav id="filtrering">
            <button data-podcast="alle" class="valgt alleknap">Alle</button>
        </nav>
        <section id="oversigt"></section>
    </main>
</section>

<template>
    <article class="article">
        <img src="" alt="" class="billede">
        <h2 class="titel"></h2>
        <h3 class="underoverskrift"></h3>
        <p></p>
        <button class="button">Læs mere</button>
    </article>
</template>

<script>
    let podcasts;
    let categories;
    let filtrerPod = "alle";

    const liste = document.querySelector("#oversigt");
    const skabelon = document.querySelector("template");
    let filterPod = "alle";
    document.addEventListener("DOMContentLoaded", start);

    function start() {
        getJson();
    }


    const url = "https://neanderpetersen.dk/kea/09_cms/radioloud/wp-json/wp/v2/podcast?per_page=100";
    const catUrl = "https://neanderpetersen.dk/kea/09_cms/radioloud/wp-json/wp/v2/categories";

    async function getJson() {
        let response = await fetch(url);
        let catresponse = await fetch(catUrl);
        podcasts = await response.json();
        categories = await catresponse.json();
        console.log(categories);
        visPodcasts();
        opretKnapper();
    }


    function opretKnapper() {
        categories.forEach(cat => {
            document.querySelector("#filtrering").innerHTML += `<button class="filter" data-podcast="${cat.id}">${cat.name}</button>`

        })

        klikKnap();
    }


    function klikKnap() {
        document.querySelectorAll("#filtrering button").forEach(elm => {
            elm.addEventListener("click", filtrering);
        })
    }

    function filtrering() {
        filtrerPod = this.dataset.podcast;
        console.log(filtrerPod);

        document.querySelector(".valgt").classList.remove("valgt");
        this.classList.add("valgt");

        visPodcasts();

    }

    function visPodcasts() {
        console.log(podcasts);
        liste.innerHTML = "";
        podcasts.forEach(podcast => {
            if (filtrerPod == "alle" || podcast.categories.includes(parseInt(filtrerPod))) {

                const klon = skabelon.cloneNode(true).content;
                klon.querySelector("img").src = podcast.billede.guid;
                klon.querySelector("p").textContent = podcast.kortbeskrivelse;
                klon.querySelector("h2").textContent = podcast.title.rendered;
                klon.querySelector("article").addEventListener("click", () => {
                    location.href = podcast.link;
                })

                liste.appendChild(klon);
            }
        })
    }

</script>

<?php
get_footer();
