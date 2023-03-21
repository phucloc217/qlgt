<template>
    <div class="container-fluid h-100" style="z-index:10000;">
        <div class="h-100">
            <div class="position-absolute bottom-50 start-50">
                <atom-spinner :animation-duration="1000" :size="100" color="green" />
            </div>
        </div>
    </div>
</template>
<script>
import { AtomSpinner } from 'epic-spinners'
export default
    {
        name: 'LoadingScreen',
        components: {
            AtomSpinner,
        }
    }
</script>
<style scoped>
.spinner {
  display: block;
  position: fixed;
  z-index: 1031; /* High z-index so it is on top of the page */
  top: 50%;
  right: 50%; /* or: left: 50%; */

}
</style>