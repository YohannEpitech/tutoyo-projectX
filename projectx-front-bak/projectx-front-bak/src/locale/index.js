import Vue from 'vue'
import VueI18n from 'vue-i18n'

Vue.use(VueI18n)

const i18n = new VueI18n({
  locale:'fr',
  messages:{
    fr:{
      MenuWelcome:"Accueil",
      MenuProfile:'Mon profil',
      MenuLogin:'S\'identifier',
      MenuLogout:'Déconnexion',
      MenuRegister:'S\'enregistrer',
      MenuSearch:'Rechercher',
      MenuAdminTutos:'Gestion des tutos',
      MenuCreateTuto:'Création d\'un tuto',
      MenuAdminUsers:'Gestion des utilisateurs',
      MenuAdminLangages:'Gestion des langages',
      sign:{
        email : 'Email',
        password: 'Mot de passe',
        login:'Soumettre',
        logintitle:'S\'authentifer',
        signuptitle:"S'enregistrer",
        username:'Surnom',
        c_password:"Confirmation du mot de passe"
      },
      home:{
        dashboard:"Mon tableau de bord",
        mytutos:'Mes tutoriels',
        followtutos:"Les tutos que je suis",
        empty:'Aucun tutoriel de suivi'
      },
      tuto:{
        edit:'Editer ce tuto',
        read:'Lire ce tuto',
        archive:'Archiver ce tuto',
        follow:'Suivre ce tuto',
        nofollow:"Ne plus suivre ce tuto",
        easy:'Facile',
        medium:'Moyen',
        pro:'Experimenté',
        wip:'En cours',
        available:'Disponible',
        archived:'Archivé',
        by:'par',
      }

    },
    en:{
      MenuWelcome:'Welcome',
      MenuProfile:'My profile',
      MenuLogin:'Sign-in',
      MenuLogout:'Logout',
      MenuRegister:'Sign-up',
      MenuSearch:'Search',
      MenuCreateTuto:'Manage tutos',
      MenuAdminUsers:'Manage users',
      MenuAdminLangages:'Manage lanages',
      MenuCreateTuto:'Create tuto',
      sign:{
        email : 'Email',
        password: 'Password',
        login:'Submit',
        logintitle:'Login',
        username:'Username',
        signuptitle:"Sign-up",
        c_password:"Password confirmation"
      },
      home:{
        dashboard:"My dashboard",
        mytutos:'My tutos',
        followtutos:"Follow tutos",
        empty:'No tutorial for you'
      },
      tuto:{
        edit:'Edit this tuto',
        read:'Read this tuto',
        archive:'Archive this tuto',
        follow:'Follow this tuto',
        nofollow:"Stop follow",
        easy:'Easy',
        medium:'Medium',
        pro:'Experimented',
        wip:'WIP',
        available:'Available',
        archived:'Archived',
        by:'by',

      }




    }
  }

})

export default i18n
