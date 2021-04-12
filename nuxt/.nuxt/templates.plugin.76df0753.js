import Vue from 'vue'
import { library, config } from '@fortawesome/fontawesome-svg-core'
import { FontAwesomeIcon, FontAwesomeLayers, FontAwesomeLayersText } from '@fortawesome/vue-fontawesome'

config.autoAddCss = false

    import  { faGithub as fortawesomefreebrandssvgicons_faGithub } from '@fortawesome/free-brands-svg-icons'
    library.add(fortawesomefreebrandssvgicons_faGithub)

    import  { faFacebook as fortawesomefreebrandssvgicons_faFacebook } from '@fortawesome/free-brands-svg-icons'
    library.add(fortawesomefreebrandssvgicons_faFacebook)

    import  { faTwitter as fortawesomefreebrandssvgicons_faTwitter } from '@fortawesome/free-brands-svg-icons'
    library.add(fortawesomefreebrandssvgicons_faTwitter)

    import  { faInstagram as fortawesomefreebrandssvgicons_faInstagram } from '@fortawesome/free-brands-svg-icons'
    library.add(fortawesomefreebrandssvgicons_faInstagram)

    import  { faLinkedinIn as fortawesomefreebrandssvgicons_faLinkedinIn } from '@fortawesome/free-brands-svg-icons'
    library.add(fortawesomefreebrandssvgicons_faLinkedinIn)

Vue.component('fa', FontAwesomeIcon)
Vue.component('fa-layers', FontAwesomeLayers)
Vue.component('fa-layers-text', FontAwesomeLayersText)
