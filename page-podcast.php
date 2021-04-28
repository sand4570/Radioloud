<?php 

/**
*The page wich displays loop wiew
*/

// Som også udskrevet ovenfor, sørger vores page-podcast.php for loop viewet af vores forskellige podcast, hentet med json via SP api. Først henter den headeren fra vores parent theme.
get_header();
?>

<!--I vores primary section, har vi al det indhold der skal skrives direkte ud på siden med loop view. Fx vil vi gerne have en statisk overskrift der hedder "Podcasts". Denne section indeholder også en anden section med id'et "oversigt". Det er her vi kloner vores loop view ind. -->
<section id="primary" class="content-area">
    <main id="main" class="site-main">

        <h1 id="podcastsh1">Podcasts</h1>

        <nav id="filtrering">
            <button data-podcast="alle" class="valgt alleknap">Alle</button>
        </nav>
        <section id="oversigt"></section>
    </main>
</section>

<!--I nedenstående template-tag, findes strukturen for hvordan hver enkel podcast i loop viewet skal være opbygget og struktureret. -->
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
    // I scriptet til vores loop view, har vi startet med at sætte variabler, der skal bruges i senere funktioner. Derudover har vi tilføjet en funktion, der henter al json
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

    //Nedenstående variabler skal vi bruge, når vi indhenter al json. Via disse links kan vi både se alle vores podcast custom posts, og de kategorier vi har oprettet til filtrering
    const url = "https://neanderpetersen.dk/kea/09_cms/radioloud/wp-json/wp/v2/podcast?per_page=100";
    const catUrl = "https://neanderpetersen.dk/kea/09_cms/radioloud/wp-json/wp/v2/categories";

    //I vores asynkrone funktion, sætter vi først to variabler, der definerer at der skal afventes med afhentningen af indholdet fra vores url-variabler. Derefter beder vi om at aktivere visPodcasts(), der sørger for at vores podcasts og kategorier skal vises på siden når al json er hentet ind fra vores url-variabler. Til sidst går vi fra denne funktion til opretKnapper().
    async function getJson() {
        let response = await fetch(url);
        let catresponse = await fetch(catUrl);
        podcasts = await response.json();
        categories = await catresponse.json();
        console.log(categories);
        visPodcasts();
        opretKnapper();
    }

    //Denne funktion giver os filtreringsknapperne, der er oprettet ud fra vores kategoriers id og navn. For-each-funktionen gør, at der kommer en knap for hver kategori vi har oprettet. Derefter bliver funktionen klikKnap() aktiveret.
    function opretKnapper() {
        categories.forEach(cat => {
            document.querySelector("#filtrering").innerHTML += `<button class="filter" data-podcast="${cat.id}">${cat.name}</button>`

        })

        klikKnap();
    }

    //Denne funktion gør vores filtreringsknapper klikbare.
    function klikKnap() {
        document.querySelectorAll("#filtrering button").forEach(elm => {
            elm.addEventListener("click", filtrering);
        })
    }

    //I denne funktion sørger vi for at de rigtige podcasts bliver vist, hver gang vi klikker på en ny filtreringsknap. Derefter aktiverer vi funktionen visPodcasts().
    function filtrering() {
        filtrerPod = this.dataset.podcast;
        console.log(filtrerPod);

        document.querySelector(".valgt").classList.remove("valgt");
        this.classList.add("valgt");

        visPodcasts();

    }

    //Denne funktion udskriver al vores json på vores site, når al indholdet er afhentet. Vi tilføjer her content til vores template-tag, som vi kloner ud i sektionen i vores main-tag. For-each-funktionen gør, at dette sker for hver podcast vi har oprettet.
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

//Her bliver vores footer hentet fra parent themet.
get_footer();
