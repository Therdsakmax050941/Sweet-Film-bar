<template>
  <!-- Step 1 -->
  <q-step
        :name="1"
        title="Step 1: Enter Customer Type"
        icon="edit"
        :done="step > 1"
      >
        <q-form @submit="nextStep">
          <h5>Are you a new or returning customer?</h5>
          <p>
            Learn more about SFB Analog Club at :
            <a href="https://bit.ly/3GJyArd">https://bit.ly/3GJyArd</a>
          </p>
          <div class="q-pa-md">
            <div class="q-gutter-sm">
              <q-radio
                v-model="formData.customerStatus"
                val="I am new"
                label="I am new // ใช้บริการครั้งแรก"
              />
              <q-radio
                v-model="formData.customerStatus"
                val="I am returning customere"
                label="I am returning customer // กลับเข้ามาใช้บริการ"
              />
              <q-radio
                v-model="formData.customerStatus"
                val="I am SFB Analog Club Member"
                label="I am SFB Analog Club Member"
              />
            </div>

            <div class="q-px-sm">
              <h6>Your selection is: {{ formData.customerStatus }}</h6>
            </div>
          </div>
          <q-input outlined type="text" v-model="formData.name" label="Name" />
          <q-input
            outlined
            type="email"
            v-model="formData.email"
            label="Email"
          />
          <q-input outlined type="tel" v-model="formData.phone" label="Phone" />
          <q-btn
            :loading="loading[0]"
            type="submit"
            class="move-top"
            color="secondary"
            @click="simulateProgress(0)"
            label="Next"
          />
        </q-form>
      </q-step>
</template>

<script>
import { defineProps } from 'vue';
export default {
  props: {
    parentData: {
      type: Object,
      required: true
    }
  },
};
</script>
