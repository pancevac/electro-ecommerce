<script>
  export default {
    name: "notification",

    props: {
      message: {
        type: String,
      },
      type: {
        type: String,
      },
    },

    mounted() {
      this.showNotification();
    },

    methods: {
      showNotification() {

        if (this.type === 'success') {
          this.$toasted.global.toastSuccess({ message: this.message });
        } else if (this.type === 'error') {
          this.$toasted.global.toastError({ message: this.message });
        } else {
          this.$toasted.global.toastDefault({ message: this.message });
        }
      }
    },
  }
</script>