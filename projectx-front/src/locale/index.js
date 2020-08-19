import Vue from 'vue'
import VueI18n from 'vue-i18n'

Vue.use(VueI18n)

const i18n = new VueI18n({
    locale: 'fr',
    messages: {
        fr: {
            MenuWelcome: "Accueil",
            MenuHome: 'Espace personnel',
            MenuProfile: 'Mon profil',
            MenuLogin: 'S\'identifier',
            MenuLogout: 'Déconnexion',
            MenuRegister: 'S\'enregistrer',
            MenuSearch: 'Rechercher',
            MenuAdminTutos: 'Gestion des tutos',
            MenuCreateTuto: 'Création d\'un tuto',
            MenuAdminUsers: 'Gestion des utilisateurs',
            MenuAdminLangages: 'Gestion des langages',
            back: 'Retour',
            myProfileTitle: "Mon profil",
            sign: {
                email: 'Email',
                password: 'Mot de passe',
                login: 'Connexion',
                logintitle: 'S\'authentifier',
                signuptitle: "S'enregistrer",
                username: 'Surnom',
                save: "Sauvegarder",
                c_password: "Confirmation du mot de passe",
                msgRegister: "NB: Votre role est étudiant de base. Vous ne pouvez que suivre, lire des tutos et accédere à votre profil.",
                mailRegister: "Si vous voulez changer de role, envoyez-nous un mail"
            },
            home: {
                dashboard: "Mon tableau de bord",
                mytutos: 'Mes tutoriels',
                followtutos: "Les tutos que je suis",
                empty: 'Aucun tutoriel de suivi'
            },
            tuto: {
                edit: 'Editer ce tuto',
                read: 'Lire ce tuto',
                archive: 'Archiver ce tuto',
                follow: 'Suivre ce tuto',
                nofollow: "Ne plus suivre ce tuto",
                easy: 'Facile',
                medium: 'Moyen',
                pro: 'Experimenté',
                wip: 'En cours de rédaction',
                available: 'Disponible',
                archived: 'Archivé',
                by: 'par',
            },
            read: {
                title: "Titre",
                difficulty: "Difficulté",
                state: "Etat",
                langage: "Langage",
                summary: "Résumé",
                content: "Contenu",
                downloadFiles: "Fichier à télécharger",
                uploadFiles: "Fichier à charger"

            },
            errors: {
                noTitle: 'Champ titre obligatoire',
                noState: 'Champ état obligatoire',
                noDifficulty: 'Champ difficulté obligatoire',
                noLangage: 'Champ langage required',
                msgGeneral: 'Corrigez les erreurs suivantes:'
            }

        },
        en: {
            MenuWelcome: 'Welcome',
            MenuHome: 'Home',
            MenuProfile: 'My profile',
            MenuLogin: 'Sign-in',
            MenuLogout: 'Logout',
            MenuRegister: 'Sign-up',
            MenuSearch: 'Search',
            MenuCreateTuto: 'Manage tutos',
            MenuAdminUsers: 'Manage users',
            MenuAdminLangages: 'Manage lanages',
            MenuCreateTuto: 'Create tuto',
            back: 'Back',
            myProfileTitle: "My profile",
            sign: {
                email: 'Email',
                password: 'Password',
                login: 'Submit',
                logintitle: 'Login',
                username: 'Username',
                signuptitle: "Sign-up",
                save: "Save",
                c_password: "Password confirmation",
                msgRegister: "NB: Your role is a basic student. You can only follow, read tutorials and access your profile.",
                mailRegister: "If you want change your role, send us an email"


            },
            home: {
                dashboard: "My dashboard",
                mytutos: 'My tutos',
                followtutos: "Follow tutos",
                empty: 'No tutorial for you'
            },
            tuto: {
                edit: 'Edit this tuto',
                read: 'Read this tuto',
                archive: 'Archive this tuto',
                follow: 'Follow this tuto',
                nofollow: "Stop follow",
                easy: 'Easy',
                medium: 'Medium',
                pro: 'Experimented',
                wip: 'WIP',
                available: 'Available',
                archived: 'Archived',
                by: 'by',

            },
            read: {
                title: "Title",
                difficulty: "Difficulty",
                state: "State",
                langage: "Langage",
                summary: "Summary",
                content: "Content",
                downloadFiles: "File to download",
                uploadFiles: "File to upload"
            },
            errors: {
                noTitle: 'Title required',
                noState: 'State required',
                noDifficulty: 'Difficulty required',
                noLangage: 'Langage required',
                msgGeneral: 'Please correct the following error(s):'
            }




        }
    }

})

export default i18n