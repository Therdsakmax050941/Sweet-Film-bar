<template>
  <div class="form">
    <q-stepper v-model="step" ref="stepper" color="primary" animated>
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
            <a href="https://bit.ly/3GJyArd" target="_blank"
              >https://bit.ly/3GJyArd</a
            >
          </p>
          <div class="q-pa-md">
            <img
              class="content01"
              src="../../assets/content1.png"
              alt="content01"
            />
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
      <!-- Step 2 -->
      <q-step
        :name="2"
        title="Step 2: Choose Contact Method"
        icon="perm_contact_calendar"
        :done="step > 2"
      >
        <q-input
          outlined
          type="email"
          v-model="formData.GoogleDrive"
          label="Your google drive email"
        />
        <q-input
          outlined
          type="email"
          v-model="formData.Instagram"
          label="Instagram"
        />
        <q-input
          outlined
          type="email"
          v-model="formData.Facebook"
          label="Facebook"
        />
        <q-input outlined type="email" v-model="formData.Line" label="LINE" />
        <br />
        <q-btn
          icon="arrow_back"
          @click="previousStep"
          label="Previous"
          flat
          color="primary"
          class="q-mr-sm move-top"
        />
        <q-btn
          :loading="loading[0]"
          type="submit"
          class="move-top"
          color="primary"
          @click="simulateProgress(0), nextStep()"
          label="Next"
        />
      </q-step>
      <!-- Step 3 -->
      <q-step
        :name="3"
        title="Step 3: About your film"
        icon="perm_contact_calendar"
        :done="step > 3"
      >
        <h6>
          How many films do you send us today?<br />
          คุณส่งฟิล์มให้กับเรากี่ม้วน?
        </h6>
        <div class="q-pa-md">
          <div class="q-gutter-sm">
            <q-radio v-model="formData.FilmTotal" val="1" label="1" />
            <q-radio v-model="formData.FilmTotal" val="2" label="2" />
            <q-radio v-model="formData.FilmTotal" val="3" label="3" />
            <q-radio v-model="formData.FilmTotal" val="4" label="4" />
            <q-radio v-model="formData.FilmTotal" val="5" label="5" />
            <q-radio
              v-model="formData.FilmTotal"
              val="6"
              label="6 or more / ตั้งแต่ 6 ขึ้นไป"
            />
          </div>
        </div>
        <hr />
        <div class="q-pa-md">
          <div class="q-gutter-sm">
            <h6>
              How did you send your film?<br />
              คุณจัดส่งฟิล์มให้เราอย่างไร?
            </h6>
            <q-radio
              v-model="formData.FilmDeliveryTypeFromCustomer"
              val="Submit at SFB"
              label="Submit at SFB / ส่งด้วยตนเองที่หน้าร้าน"
            />
            <q-radio
              v-model="formData.FilmDeliveryTypeFromCustomer"
              val="Parcel Delivery"
              label="Parcel Delivery / ไปรษณีย์ หรือ พัสดุ"
            />
            <q-radio
              v-model="formData.FilmDeliveryTypeFromCustomer"
              val="Express Delivery"
              label="Express Delivery / ส่งด้วยแกรป หรือจัดส่งด่วน"
            />
            <q-radio
              v-model="formData.FilmDeliveryTypeFromCustomer"
              val="Film Dropbox"
              label="Film Dropbox / ตู้รับฟิล์ม"
            />
            <q-radio
              val="อื่นๆ"
              v-model="formData.FilmDeliveryTypeFromCustomer"
              label="อื่นๆ"
            />
            <!-- เงื่อนไขในการแสดงหรือซ่อนฟอร์มเพิ่มเติม -->
            <div v-if="formData.FilmDeliveryTypeFromCustomer === 'อื่นๆ'">
              <q-input
                outlined
                v-model="formData.FilmDeliveryTypeFromCustomerOther"
                label="Other Delivery Type"
              />
            </div>
          </div>
        </div>

        <br />
        <q-btn
          icon="arrow_back"
          @click="previousStep"
          label="Previous"
          flat
          color="primary"
          class="q-mr-sm move-top"
        />
        <q-btn
          :loading="loading[0]"
          type="submit"
          class="move-top"
          color="primary"
          @click="simulateProgress(0), nextStep()"
          label="Next"
        />
      </q-step>
      <!-- Step 4 -->
      <q-step
        :name="4"
        title="Step 4: Enter About Your Film"
        icon="perm_contact_calendar"
        :done="step > 4"
      >
        <p>
          Tell us about your film(s) Please describe your film & requirements
          asbest as you can
        </p>
        <p>
          //กรุณาอธิบายรายละเอียดและความต้องการเกี่ยวกับฟิล์มของท่าน<br />
          (1) Film name
        </p>
        <p>
          // ชื่อของฟิล์ม <br />(2) Film type // ประเภทของฟิล์ม - ฟิล์มสี c41 -
          ฟิล์มขาวดำ b/w - ฟิล์มหนัง ecn2 - ฟิล์มสไลด์ e6 <br />(3) Expired? //
          ฟิล์มหมดอายุแล้วหรือไม่?<br />
          (4) Push or pull? // ต้องการ push หรือ pull ฟิล์มหรือไม่? อย่างไร?<br />
          สอบถามเพิ่มเติมได้ที่
          <a href="https://m.me/sweetfilmbar" target="_blank"
            >m.me/sweetfilmbar</a
          >
        </p>
        <div>
          <q-btn
            icon="arrow_forward"
            @click="nextStepForm"
            v-if="stepForm <= parseInt(formData.FilmTotal)"
          />
          <transition name="fade" mode="out-in">
            <q-input
              outlined
              color="blue"
              :key="stepForm"
              v-if="stepForm <= parseInt(formData.FilmTotal)"
              v-model="FormInput"
              :label="`About Film ${stepForm}`"
            />
          </transition>
        </div>
        <br />
        <q-btn
          icon="arrow_back"
          @click="previousStep"
          label="Previous"
          flat
          color="primary"
          class="q-mr-sm move-top"
        />
        <q-btn
          :loading="loading[0]"
          type="submit"
          class="move-top"
          color="primary"
          @click="simulateProgress(0), nextStep()"
          label="Next"
          :disable="stepForm <= parseInt(formData.FilmTotal)"
        />
      </q-step>
      <!-- Step 5 -->
      <q-step
        :name="5"
        title="Step 5: Enter Send back services"
        icon="perm_contact_calendar"
        :done="step > 5"
      >
        <div>
          <h6>What should we do with your film?</h6>
          <q-radio
            v-model="formData.DeliveryBack"
            val="I will pick up at shop"
            label="I will pick up at shop / จะมารับที่ร้าน"
          />
          <q-radio
            v-model="formData.DeliveryBack"
            val="MyAddress"
            label="Please send to my address (+50b)/ กรุณาจัดส่งกลับ (เพิ่ม 50 บาท)"
          />
          <q-radio
            v-model="formData.DeliveryBack"
            val="I don't want it"
            label="I don't want it / ฉันไม่ต้องการรับกลับ"
          />

          <div v-if="formData.DeliveryBack === 'MyAddress'">
            <q-input
              outlined
              v-model="formData.Address"
              label="please give full address details"
            />
          </div>

          <hr />
          <div>
            <h6>
              Special requests?<br />
              มีความต้องการพิเศษอื่นๆ หรือไม่ โปรดระบุ
            </h6>
            <q-input
              outlined
              v-model="formData.NoteExtra"
              label="Special requests? (If no, please leave blank)"
            />
            <h6>What should we do with your negatives?</h6>
            <div class="q-pa-md row items-start q-gutter-md">
              <q-card class="my-card">
                <q-img src="https://lh4.googleusercontent.com/iDMA-5PI5ihWsIudmKeyTxNrmqnxeeZn3SQ9bMhvW8A11Cuef1qafe6O46ZppVhXGHF8TXCLPZVWSZ2_4HwH4jYFZtitYvERrecaEa-9zO6k2-noiRw8E5upIJF2VlIzJw=w260">
                </q-img>
                <q-card-section>
                  <q-radio
                  v-model="formData.PackageFilmDelivery"
                  val="Use non-PVC film archival sleeves"
                  label="Use non-PVC film archival sleeves (+30 Baht/roll)"
                />
                </q-card-section>
              </q-card>

              <q-card class="my-card">
                <q-img src="https://lh3.googleusercontent.com/JXwfeFVHTaQm9hJ61QSauzvN4mHRiaSAhVbiT3awJTBFiMqvpNOCsGG-5KGWVwcGO7DRmZPypzqHXF9SZ087JzUbQ6cEA0q8Dt9M-qjzCyRn9eAVMlz4Y63xnUYKGoQB8w=w260">
                </q-img>
                <q-card-section>
                  <q-radio
                  v-model="formData.PackageFilmDelivery"
                  val="Use non-PVC film archival sleeves"
                  label="Use non-PVC film archival sleeves (+30 Baht/roll)"
                />
                </q-card-section>
              </q-card> 
              
              <q-card class="my-card">
                <q-card-section>
                  <q-radio
                v-model="formData.PackageFilmDelivery"
                val="I don't want it"
                label="I don't want it / ฉันไม่ต้องการรับกลับ"
              />
                </q-card-section>
              </q-card>
            </div>
            <h6>Dev & Scan Delivery Policy</h6>
            <p>
              🔵 C41 : ล้างฟิล์มสี Color Negative |
              เราให้บริการด้วยเครื่องล้างฟิล์มอัตโนมัติ Noritsu QSF-V30
              สำหรับฟิล์มสี Color Negative ทั่วไปในกรณีที่้เป็นฟิล์มไม่หมดอายุ
              งานล้าง-สแกนฟิล์มจะเสร็จพร้อมแชร์งานภาพผ่าน Google Drive
              ภายในวันที่คุณลูกค้าจัดส่ง (ตัดรอบที่ 2 ชั่วโมงก่อนปิดร้าน)
            </p>
            <p>
              🔴 BW, ECN2, E6 : ล้างฟิล์มขาวดำ, ฟิล์มหนัง, ฟิล์มสไลด์
              จะลงมือเริ่มล้างฟิล์มในวันที่จัดส่งงานนั้น (ตัดรอบที่ 2
              ชั่วโมงก่อนปิดร้าน) โดยลูกค้าจะได้รับงานผ่าน Google Drive ภายใน
              1-3 วัน (ล้างฟิล์มด้วยระบบมือ Handcraft Film Developing,
              รอฟิล์มแห้ง และการตรวจสอบคุณภาพต่างๆ)
            </p>
            <p>
              ทางร้านให้ความสำคัญกับคุณภาพของภาพ
              โดยเราเลือกใช้เครื่องสแกนคุณภาพสูง Noritsu HS-1800
              ที่สามารถสแกนฟิล์ม 135 และ 120 ได้อย่างคมชัดและรวดเร็ว
              โดยทุกงานสแกนจะได้รับการอัพเกรดจาก Standard เพิ่มเป็น Enhanced
              High-Resolution Scan โดยไม่มีค่าใช้จ่ายเพิ่มเติม
            </p>
            <p>
              เราจัดส่งงานภาพผ่านทาง Google Drive
              เพื่อไม่ให้เสียคุณภาพของภาพจากการบีบอัดภาพ (uncompressed &
              lossless) ทางร้านรักษาไฟล์ผ่าน Google Drive โดยไม่มีกำหนดระยะเวลา.
            </p>
            <p>
              <a href="https://bit.ly/sweetfilmbar" target="_blank"
                >สอบถามเพิ่มเติมได้ทาง bit.ly/sweetfilmbar</a
              >
            </p>
          </div>
        </div>
        <br />
        <q-btn
          icon="arrow_back"
          @click="previousStep"
          label="Previous"
          flat
          color="primary"
          class="q-mr-sm move-top"
        />
        <q-btn
          :loading="loading[0]"
          type="submit"
          class="move-top"
          color="primary"
          @click="simulateProgress(0), nextStep()"
          label="Next"
          :disable="stepForm <= parseInt(formData.FilmTotal)"
        />
      </q-step>
      <!-- Step6-->
       <q-step
        :name="6"
        title="Step 4: Review Information"
        icon="description"
        :done="step > 4"
      >
        <div class="column" style="height: 150px">
          <p class="col-4 col-md-3"><strong>Customer Type  : </strong> {{ formData.customerStatus }}</p>
          <p class="col-4 col-md-3"><strong>Name  : </strong> {{ formData.FullName }}</p>
          <p class="col-4 col-md-3"><strong>Email : </strong> {{ formData.email }}</p>
          <p class="col-4 col-md-3"><strong>Phone : </strong> {{ formData.phone }}</p>
          <p class="col-4 col-md-3"><strong>Email Drive : </strong> {{ formData.GoogleDrive }}</p>
          <p class="col-4 col-md-3"><strong>LINE ID : </strong> {{ formData.Line }}</p>
        </div>
  
        <div>
          <h5>Films Total : {{ formData.data.FilmTotal }}</h5>
          <ul v-for="(index, item) in formData.data.AboutFilm" :key="index">
            <li><h6> Film Details{{ item + 1 }} : {{ formData.data.AboutFilm[item] }}</h6></li>
          </ul>
        </div>
        <div style="margin-top: 20px;">
          <p>Note : {{ formData.NoteExtra }}</p>
        </div>
        <div style="margin-top: 20px;">
          <q-btn
          @click="previousStep"
          label="Previous"
          flat
          color="primary"
          class="q-mr-sm"
        />
        <q-btn @click="submitForm" label="SendForm" color="primary" icon="send" />
        </div>
      </q-step> 
    </q-stepper>
  </div>
</template>

<script>
import { ref } from "vue";

export default {
  data() {
    return {
      step: 1,
      stepForm: 1,
      FormInput: "",
      formData: {
        data: {
          customerStatus: "",
          FullName: "",
          Email: "",
          Phone: "",
          GoogleDrive: "",
          Instagram: "",
          Facebook: "",
          Line: "",
          FilmTotal: "",
          FilmDeliveryTypeFromCustomer: "",
          FilmDeliveryTypeFromCustomerOther: "",
          AboutFilm: [],
          DeliveryBack: "",
          Address: "",
          NoteExtra: "",
          FilmBackType: "",
          PackageFilmDelivery:"",
          StatusOrder: {
            CustomerStatusOrder: "OpenOrder",
            PaymentTotal: "",
            PaymentStatus: false,
          },
        },
      },
    };
  },
  methods: {
    nextStepForm() {
      if (this.stepForm <= this.formData.FilmTotal && this.FormInput != "") {
        this.formData.data.AboutFilm.push(this.FormInput);
        this.stepForm++;
        this.FormInput = "";
      } else {
        alert("Please fill in all required fields.");
      }
    },
    nextStep() {
      setTimeout(() => {
        this.step++;
      }, 2000);
    },
    previousStep() {
      this.step--;
    },
    submitForm() {
      var myHeaders = new Headers();
myHeaders.append("Content-Type", "application/json");

var raw = JSON.stringify(this.formData);

var requestOptions = {
  method: 'POST',
  headers: myHeaders,
  body: raw,
  redirect: 'follow'
};

fetch("http://localhost:8000/api/", requestOptions)
  .then(response => response.text())
  .then(result => console.log(result))
  .catch(error => console.log('error', error));
    },
    inputChange(event, i) {
      this.formData.data.AboutFilm.push(event);
    },
  },
  setup() {
    const loading = ref([false, false, false, false, false, false]);
    const progress = ref(false);

    function simulateProgress(number) {
      // we set loading state
      loading.value[number] = true;
      // simulate a delay
      setTimeout(() => {
        // we're done, we reset loading state
        loading.value[number] = false;
      }, 2000);
    }
    return {
      loading,
      progress,
      simulateProgress,
    };
  },
};
</script>

<style scoped>
</style>
