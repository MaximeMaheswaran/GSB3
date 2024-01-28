<script>
    const searchInput = document.getElementById("search");
    const table_resultat = document.getElementById("table_resultat");
    let list_ordonnee;
    async function getVisiteurs() {
        const res = <?= json_encode($visiteursAValider) ?>;
        list_ordonnee = orderList(res);
        creeVisiteur(list_ordonnee);
        console.log(list_ordonnee);
    }

    function orderList(data) {
        return data.sort((a, b) => {
            if (a.nom.toLowerCase() < b.nom.toLowerCase()) {
                return -1;
            } else if (a.nom.toLowerCase() > b.nom.toLowerCase()) {
                return 1;
            } else {
                return 0;
            }
        });
    }

    function creeVisiteur(listVisiteurs) {
        listVisiteurs.forEach(visiteur => {
            const listItems = document.createElement("div");
            listItems.setAttribute("class", "table_items");

            listItems.innerHTML = `
            <h4>${visiteur.nom + " " + visiteur.prenom}</h4>
            <h4>${visiteur.salle}</h4>
            <h4>${visiteur.horaire}</h4>
            <h4>
                <form action='/Agent/Visiteur/A_valider' method='post'>
                    <input type="hidden" name="idVisiteur" value="${visiteur.id}">
                    <input type="submit" value="Est présent" id="bouton_aValider">
                </form>
            </h4>
        `;
            table_resultat.appendChild(listItems);
        });
    }

    getVisiteurs();
    searchInput.addEventListener("input", filterData)

    function filterData(e) {

        table_resultat.innerHTML = "";

        const motRechercher = e.target.value.toLowerCase().replace(/\s/g, "");

        const dataFiltrer = list_ordonnee.filter(element =>
            element.nom.toLowerCase().includes(motRechercher) ||
            element.prenom.toLowerCase().includes(motRechercher) ||
            `${element.nom + element.prenom}`.toLowerCase().replace(/\s/g, "").includes(motRechercher) ||
            `${element.prenom + element.nom}`.toLowerCase().replace(/\s/g, "").includes(motRechercher)

        );

        creeVisiteur(dataFiltrer);
    }
</script>