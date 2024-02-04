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


            if (<?= isset($page) ?>) {
                // Vérification si je dois afficher le bouton ou pas, si la page est la page A valider alors oui
                if (<?= '"' . $page . '"' ?> == "AValider") {
                    listItems.innerHTML = `
                    <h4>${visiteur.nom + " " + visiteur.prenom}</h4>
                    <h4>${visiteur.salle}</h4>
                    <h4>${visiteur.horaire}</h4>
                    <h4 class="bouton_est_present">
                        <form action='/gsb3/public/index.php/Agent/Visiteur/A_valider' method='post'>
                            <input type="hidden" name="horaireAValider" value="${visiteur.horaire}">
                            <input type="hidden" name="idPresentationAValider" value="${visiteur.idPresentation}">
                            <input type="hidden" name="idVisiteurAValider" value="${visiteur.id}">
                            <input type="submit" value="Est présent" id="bouton_aValider">
                        </form>
                    </h4>
                    `;
                } else {
                    listItems.innerHTML = `
                    <h4>${visiteur.nom + " " + visiteur.prenom}</h4>
                    <h4>${visiteur.salle}</h4>
                    <h4>${visiteur.horaire}</h4>
                    `;
                }
            }



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