<script>
    import { Link } from '@inertiajs/svelte';
    import Layout from '../Shared/Layout.svelte';
    import SubmitButton from '../Shared/SubmitButton.svelte';
    import Button from '../Shared/Button.svelte';
    import CenterDiv from '../Shared/CenterDiv.svelte';
    import H1 from '../Shared/H1.svelte';

    let registered = false;

    let data = {
      name: '',
      email: '',
      password: '',
      password_confirmation: '',
      terms: false
    };

    let errors = {
      name: '',
      email: '',
      password: '',
      password_confirmation: '',
      terms: ''
    };

    let submit = () => {
      axios.post('register', {
          name: data.name,
          email: data.email,
          password: data.password,
          password_confirmation: data.password_confirmation,
          terms: data.terms
      })
      .then(response => {
          if (response.status === 200) {
            registered = true;
          }
      })
      .catch(error => {
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
</script>

<Layout>
    <CenterDiv>
        <div class="tw-text-center">
          {#if registered == true}
            <h1 class="tw-mb-6">Sie wurden registriert.</h1>
            <Button link="/login">Anmelden</Button>
          {:else}
          <!-- <form on:submit|preventDefault={submit} class="tw-text-center tw-bg-slate-100 tw-p-8 tw-rounded-md">
              <div class="tw-flex tw-flex-col tw-w-full tw-mb-6">
                <label class="tw-text-lg tw-mb-2" for="username">Username</label>
                <input on:input={(evt)=>data.name = evt.target.value} class="tw-border tw-border-gray-400 tw-rounded tw-w-full tw-py-2 tw-px-3" type="text" id="username" />
                <span class="tw-text-red-500 tw-text-sm tw-mt-1">{errors.name}</span>
              </div>
            
              <div class="tw-flex tw-flex-col tw-w-full tw-mb-6">
                <label class="tw-text-lg tw-mb-2" for="email">Email</label>
                <input on:input={(evt)=>data.email = evt.target.value} class="tw-border tw-border-gray-400 tw-rounded tw-w-full tw-py-2 tw-px-3" type="email" id="email" />
                <span class="tw-text-red-500 tw-text-sm tw-mt-1">{errors.email}</span>
              </div>
            
              <div class="tw-flex tw-flex-col tw-w-full tw-mb-6">
                <label class="tw-text-lg tw-mb-2" for="password">Password</label>
                <input on:input={(evt)=>data.password = evt.target.value} class="tw-border tw-border-gray-400 tw-rounded tw-w-full tw-py-2 tw-px-3" type="password" id="password" />
                <span class="tw-text-red-500 tw-text-sm tw-mt-1">{errors.password}</span>
              </div>
            
              <div class="tw-flex tw-flex-col tw-w-full tw-mb-6">
                <label class="tw-text-lg tw-mb-2" for="password-confirm">Confirm Password</label>
                <input on:input={(evt)=>data.password_confirmation = evt.target.value} class="tw-border tw-border-gray-400 tw-rounded tw-w-full tw-py-2 tw-px-3" type="password" id="password-confirm" />
                <span class="tw-text-red-500 tw-text-sm tw-mt-1">{errors.password_confirmation}</span>
              </div>

              <div class="tw-mb-4">
                <label for="acceptDataAgreements" class="tw-block tw-text-gray-700 tw-font-bold tw-mb-1">Accept <a class="tw-text-gray-700 hover:tw-text-black" href="https://www.krems.at/datenschutzerklaerung">Data Agreements</a></label>
                <input on:input={(evt)=>data.terms = evt.target.checked} type="checkbox" class="tw-mt-1" id="acceptDataAgreements" />
                <span class="tw-text-red-500 tw-text-sm tw-mt-1">{errors.terms}</span>
              </div>

              <SubmitButton>Create Account</SubmitButton>
            </form>

              <div class="tw-text-center tw-mt-2">
                <Link href="/login" class="tw-text-sm tw-text-gray-700 hover:tw-text-black">Anmelden</Link>
              </div> -->
              <div class=" tw-bg-gray-50 tw-border tw-p-5 tw-rounded-xl">
                <h1 class="tw-mb-5  tw-border-b tw-border-black">Registrieren</h1>
                <form on:submit|preventDefault={submit}>
                    <div class="tw-mb-3">
                      <label for="name" class="tw-block tw-text-sm tw-font-medium tw-text-gray-700">Name</label>
                      <input type="text" name="name" id="name" class="tw-mt-1 tw-p-2 tw-block tw-w-full tw-border tw-border-gray-300 tw-rounded-md tw-shadow-sm focus:tw-outline-none focus:tw-ring-indigo-500 focus:tw-border-indigo-500 sm:tw-text-sm" placeholder="Max Mustermann" bind:value={data.name}>
                      <span class="tw-text-red-500 tw-text-sm">{errors.name}</span>
                  </div>
                    <div class="tw-mb-3">
                        <label for="email" class="tw-block tw-text-sm tw-font-medium tw-text-gray-700">E-Mail</label>
                        <input type="email" name="email" id="email" class="tw-mt-1 tw-p-2 tw-block tw-w-full tw-border tw-border-gray-300 tw-rounded-md tw-shadow-sm focus:tw-outline-none focus:tw-ring-indigo-500 focus:tw-border-indigo-500 sm:tw-text-sm" placeholder="E-Mail" bind:value={data.email}>
                        <span class="tw-text-red-500 tw-text-sm">{errors.email}</span>
                    </div>
                    <div class="tw-mb-3">
                        <label for="password" class="tw-block tw-text-sm tw-font-medium tw-text-gray-700">Passwort</label>
                        <input type="password" name="password" id="password" class="tw-mt-1 tw-p-2 tw-block tw-w-full tw-border tw-border-gray-300 tw-rounded-md tw-shadow-sm focus:tw-outline-none focus:tw-ring-indigo-500 focus:tw-border-indigo-500 sm:tw-text-sm" placeholder="Passwort" bind:value={data.password}>
                        <span class="tw-text-red-500 tw-text-sm">{errors.password}</span>
                    </div>
                    <div class="tw-mb-3">
                        <label for="password_confirmation" class="tw-block tw-text-sm tw-font-medium tw-text-gray-700">Passwort bestätigen</label>
                        <input type="password" name="password_confirmation" id="password_confirmation" class="tw-mt-1 tw-p-2 tw-block tw-w-full tw-border tw-border-gray-300 tw-rounded-md tw-shadow-sm focus:tw-outline-none focus:tw-ring-indigo-500 focus:tw-border-indigo-500 sm:tw-text-sm" placeholder="Passwort" bind:value={data.password_confirmation}>
                        <span class="tw-text-red-500 tw-text-sm">{errors.password_confirmation}</span>
                    </div>
                    <div class="tw-mb-3">
                        <label for="terms" class="tw-block tw-text-sm tw-font-medium tw-text-gray-700"><Link href="https://www.krems.at/datenschutzerklaerung">Datenschutzrichtlinien</Link> akzeptieren</label>
                        <input type="checkbox" name="terms" id="terms" class="tw-shadow-none tw-mt-1 tw-p-2 tw-block tw-w-full tw-border tw-border-gray-300 tw-rounded-md focus:tw-outline-none focus:tw-ring-indigo-500 focus:tw-border-indigo-500 sm:tw-text-sm" bind:checked={data.terms}>
                        <span class="tw-text-red-500 tw-text-sm">{errors.terms}</span>
                    </div>
                    <div class="tw-mb-3">
                        <SubmitButton>Registrieren</SubmitButton>
                    </div>
                </form>
            </div>
            <div class="tw-text-center tw-mt-2">
                <Link class="tw-text-sm tw-text-gray-700 hover:tw-text-black" href="/login">Anmelden</Link>
            </div>
        {/if}
      </div>
    </CenterDiv>
</Layout>