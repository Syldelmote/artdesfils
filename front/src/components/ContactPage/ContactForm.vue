<script setup>
import { useQuasar } from 'quasar'
import { ref, watch } from 'vue'
import { api } from 'src/boot/axios';
import { useRouter } from 'vue-router';

const props = defineProps({
    produit: Object
})
const $q = useQuasar()
const email = ref(null)
const article = ref('')
const reference = ref('')
const commentaire = ref('')
const accept = ref(false)
const router = useRouter()

watch(() => props.produit, (newProduit) => {
    console.log('WATCHER', props.produit)
    if (newProduit) {
        article.value = newProduit.nom
        reference.value = newProduit['@id']
    }
}, { immediate: true })

function onSubmit() {
    if (accept.value !== true) {
        $q.notify({
            color: 'red-5',
            textColor: 'white',
            icon: 'warning',
            message: 'Vous devez accepter d\'être recontacté'
        })
    }
    else {
        PostForm()
    }
}

async function PostForm() {
    const url = ('/contacts')
    const payload = {
        "email": email.value,
        "message": commentaire.value,
        "nomArticle" : article.value,
        'referenceArticle' : reference.value
    }
    if (article.value) {
        payload.nomArticle = article.value
    }
    if (reference.value) {
        payload.referenceArticle = reference.value
    }
    try {
        const response = await api.post(url, payload);
        $q.notify({
            color: 'positive',
            message: 'Formulaire envoyé avec succès!',
            icon: 'check'
        });
        router.push('/catalogue')
        return response.data;
    }

    catch (error) {
        console.error('Erreur lors de l\'envoi du formulaire:', error);
        $q.notify({
            color: 'negative',
            message: 'Erreur lors de l\'envoi du formulaire. Veuillez réessayer.',
            icon: 'error'
        });
        throw error;
    }

}

function onReset() {
    email.value = null
    accept.value = false
    commentaire.value = null
}

</script>

<template>
    <q-form @submit="onSubmit" @reset="onReset" class="q-gutter-md q-pa-md">
    
        <div v-if="article" class="row q-px-md">
            <q-input class="col-8" borderless type="text" v-model="article" label="Produit souhaité" readonly />
            <q-input class="col-4" borderless type="text" v-model="reference" label="Reference" readonly />
        </div>

        <q-input rounded outlined type="email" v-model="email" label="Adresse mail*"
            hint="*Adresse à laquelle je peux être recontactée" lazy-rules
            :rules="[val => val && val.length > 0 || 'Indiquez votre adresse mail']" />

        <q-input class="" v-model="commentaire" rounded outlined type="textarea" label="Commentaire" />

        <q-toggle v-model="accept" class="text-caption " color="accent"
            label=" J'accepte que les informations saisies dans ce formulaire soient utilisées pour permettre de me recontacter" />

        <div>
            <q-btn label="Envoyer" type="submit" color="accent" />
            <q-btn label="Reset" type="reset" color="primary" flat class="q-ml-sm" />
        </div>

    </q-form>
</template>
