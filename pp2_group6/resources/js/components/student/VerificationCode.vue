<template>

  
  <div>
    <div>
      <!-- Code is incorrect -->
      <b-alert v-model="showIncorrect" variant="danger" dismissible>
        Verification code incorrect!
      </b-alert>
      <!-- Code is expired -->
      <b-alert v-model="showExpired" variant="danger" dismissible>
        Oops! Verification code is expired, click on resend code. 
      </b-alert>
      <!-- Code insered 3 times wrong -->
      <b-alert v-model="showThree" variant="danger" dismissible>
        You entered the wrong code 3 times in a row, you can not take an appointment for 15 minutes. 
      </b-alert>
      <!-- Code is already redeemed -->
      <b-alert v-model="showUsed" variant="danger" dismissible>
        Verification code is already redeemed or student may not exist!
      </b-alert>
    </div>
    <!-- Countdown -->
    <b-alert
      :show="dismissCountDown"
      variant="dark"
      @dismissed="dismissCountDown=0"
      @dismiss-count-down="countDownChanged"
    >
      <p>The verification code will expire in {{ dismissCountDown }} seconds...</p>
      <b-progress
        variant="dark"
        :max="dismissSecs"
        :value="dismissCountDown"
        height="4px"
      ></b-progress>
    </b-alert>

    <b-form-group
      id="v_code"
      label-for="v_code-input"
      valid-feedback="Press Submit to validate.">
      <p><strong>Enter 6 digits verifictation code sent by email</strong></p>
      <b-form-input
        type="number"
        :formatter="formatCode"
        id="v_code-input"
        v-model="verificationData.v_code"
      ></b-form-input>
    </b-form-group>
    <b-button type="button"  @click="verifyCode()"
      >Verify Code</b-button
    >
  </div>

</template>

<script>
export default {
  props: ["student_firstName", "student_lastName"],
  computed: {},
  data() {
    return {
      verificationData: {
        v_code: "",
        student_firstName: "",
        student_lastName: "",
      },
      showIncorrect: false,
      showExpired: false,
      showThree: false,
      showUsed: false,
      dismissSecs: 300,
      dismissCountDown: 0
    }
  },
  mounted() {
    this.dismissCountDown = this.dismissSecs;
  },
  methods: {
    countDownChanged(dismissCountDown) {
      this.dismissCountDown = dismissCountDown
  },

    formatCode (e){
      //Limit verification code input to 6 digits.
      return String(e).substring(0,6);
    },
    verifyCode() {
      //Declaring needed variables.
      let response = "";

      //Assign props that came from parent component to this object.
      this.verificationData.student_firstName = this.$props.student_firstName;
      this.verificationData.student_lastName = this.$props.student_lastName;

      //Axios [POST] with object containing v_code, firstname & lastname. (which will be used to retrieve student_id in backend).
      axios
        .post("verifyCode/", this.verificationData)
        .then((res) => {
          if (res.data === 1) {
            //code verification successfull.
            console.log("Code verification successfull");

            //Send 1 back to the parent component.
            this.$emit("codeValidated", 1);
          } else if (res.data === 2) {
            //Code incorrect.
            this.showIncorrect = true;
            //alert("Verification code incorrect!");

          } else if (res.data === 3) {
            //Code verification
            this.showExpired = true;
            //alert("Oops. Verification code is expired!");

          } else if (res.data === 4) {
            //Code verification 3 times wrong
            //this.showThree = true;
            alert("You entered the wrong password 3 times in a row, you can not take an appointment for 15 minutes.");

            //Redirect to start page.
            window.location.href = "/";
          } else if (res.data === 0) {
            //Code verification failed
            this.showUsed = true; 
          } else {
            console.log(res.data);
          }
        })
        .catch(function (error) {
          console.log(error);
        });
    },
  },
};
</script>