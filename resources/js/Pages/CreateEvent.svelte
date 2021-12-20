<script>
    import Layout from "../Shared/Layout.svelte";
    import EventForm from "../Shared/EventForm.svelte";
    import { router } from "@inertiajs/svelte";

    let data = {
        TITLE: '',
        DESCRIPTION: '',
        EVENT_TYPE: '',
        STARTING_TIME: '',
        ENDING_TIME: '',
        CITY: '',
        POSTAL_CODE: '',
        ADDRESS: '',
        PHONE_NR: '',
        WEBSITE_URL: '',
        EMAIL: '',
        IMAGE_PATH: '',
    };

    let errors = {
        TITLE: '',
        DESCRIPTION: '',
        EVENT_TYPE: '',
        STARTING_TIME: '',
        ENDING_TIME: '',
        CITY: '',
        POSTAL_CODE: '',
        ADDRESS: '',
        PHONE_NR: '',
        WEBSITE_URL: '',
        EMAIL: '',
        IMAGE_PATH: '',
    };

    let submit = () => {
        axios.post('/events', data)
        .then(response => {
            if (response.status === 200) {
                router.get('events');
            }
        })
        .catch(error => {
            console.log(error);
            if (error?.response?.status === 422) {
                for (const [key, value] of Object.entries(errors)) {
                    if(error.response.data.errors[key]) {
                        errors[key] = error.response.data.errors[key][0];
                    } else {
                        errors[key] = '';
                    }
                }
            }
        });
    }

    /* function handleDataUpdated(event){
        data = event.detail;
    } */
</script>

<Layout>
    <h1>Create Event</h1>
    <EventForm newEvent={true} bind:data={data} bind:errors={errors} onSubmit={submit} />
</Layout>
