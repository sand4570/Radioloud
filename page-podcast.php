<?php 

/**
*The page wich displays loop wiew
*/

get_header();
?>

<section id="primary" class="content-area">
    <main id="main" class="site-main">

        <p>Insert loop html and js here</p>
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
        <p></p>
        <button class="button">Læs mere</button>
    </article>
</template>

<script>
    let podcasts;
    let categories;
    let filtrerPod = "alle";

    const liste = document.querySelector("#overskrift");
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
            document.querySelector("#filtrering").innerHTML += `<button class="filter" data-rute="${cat.id}">${cat.name}</button>`

        })

        klikKnap();
    }


    function klikKnap() {
        document.querySelectorAll("#filtrering button").forEach(elm => {
            elm.addEventListener("click", filtrering);
        })
    }

    function filtrering() {
        filtrerRute = this.dataset.podcast;
        console.log(filtrerPod);

        document.querySelector(".valgt").classList.remove("valgt");
        this.classList.add("valgt");

        visPodcasts();

    }

    function visPodcasts() {
        console.log(ruter);
        liste.innerHTML = "";
        podcasts.forEach(podcast => {
            if (filtrerPod == "alle" || podcast.categories.includes(parseInt(filtrerPod))) {

                const klon = skabelon.cloneNode(true).content;
                klon.querySelector("img").src = podcast.billede.guid;
                klon.querySelector("p").textContent = pocast.kortbeskrivelse;
                klon.querySelector("h2").textContent = pocast.titel;
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
