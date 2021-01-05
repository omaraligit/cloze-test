<!DOCTYPE html>
<html lang="en">
   <head>
      <!-- Required meta tags -->
      <meta charset="utf-8"/>
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
      <link type="text/css" rel="stylesheet" href="//unpkg.com/bootstrap/dist/css/bootstrap.min.css"/>
      <link type="text/css" rel="stylesheet" href="//unpkg.com/bootstrap-vue@latest/dist/bootstrap-vue.min.css">
      <link type="text/css" rel="stylesheet" href="css/my-css.css"/>
      <title>Cloze Test Teacher Frontend</title>
       <!-- Vue -->
       <script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
       <!-- Load Vue followed by BootstrapVue -->
       <script src="https://unpkg.com/bootstrap-vue@latest/dist/bootstrap-vue.min.js"></script>
       <!-- axios -->
       <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
   </head>
   <body>
      <main id="app" class="main">
         <section class="content">
            <div class="container-fluid">
               <!--new row-->
               <div class="row">
                  <div class="col-lg-8 col-sm-12 mb-4">
                     <div class="card">
                        <div class="card-body">
                           <div class="form-group">
                              <textarea
                                      id="cloze-text"
                                      class=" detail-wrapper form-control form-control-lg textarea-autosize"
                                      placeholder="Paste in text..." v-model="test_text" style=""></textarea>
                           </div>
                           <div class="reading-time mt-2">
                              <span class="reading-time__label"></span>
                              <span class="reading-time__duration"></span>
                              <span class="reading-time__word-count"></span>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="col-lg-4 col-sm-12 mb-4">
                     <div class="card">
                        <div class="card-body">
                           <div class="form-group flex-fill justify-content-between">
                              <label class="d-inline-flex">Number of missing Words</label>
                              <select class="d-inline-flex custom-select" v-model="test_words_count">
                                 <option value="5">5</option>
                                 <option value="10">10</option>
                                 <option value="15">15</option>
                              </select>
                           </div>
                           <div>
                              <h6>Missing words list</h6>
                              <span class="badge badge-pill badge-info mr-2 p-1 px-3" v-for="word in missing_words" >{{word.text}}</span>
                           </div>
                            <div class="row">
                                <div class="col-6 pr-1">
                                    <b-button @click="selectRandomWords" variant="info btn-block mt-4">Select random words</b-button>
                                </div>
                                <div class="col-6 pl-1">
                                    <b-button v-b-modal.schedule variant="success btn-block mt-4">Schedule Test</b-button>
                                </div>

                            </div>
                            <div class="row mt-3" v-if="error != ''">
                                <div class="col-12"><div class="alert alert-danger" ><b>{{error}}</b></div></div>
                            </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
             <div class="container-fluid">
                 <div class="row">
                     <div class="col-12" v-for="tested in testFromApi">
                         <div class=" bg-white rounded p-2 mb-3 text-justify">
                             <p class="p-2">{{ tested.text_content }}</p>
                             <hr>
                             <b>from</b> {{ tested.date_start }} <b>to</b> {{ tested.date_end }}
                             <hr>
                             <span class="badge badge-pill badge-info mr-2 p-1 px-3" v-for="word in JSON.parse(tested.words_missing)" >{{word.text}}</span>
                             <hr>
                             <a :href="'/cloze-test-student.php?id='+tested.id" class="btn btn-info btn-sm" >Visit page</a>
                             <button class="btn btn-danger" @click="deleteTest(tested.id)">Delete</button>
                         </div>
                     </div>
                 </div>
             </div>
         </section>
          <!--add teacher modal-->
         <div>
            <b-modal id="schedule" size="md" title="Schedule Cloze Test" @ok="scheduleNewTest">
               <template>
                  <div class="form-group">
                     <div>
                        <label>Start date</label>
                        <b-form-datepicker id="startDate" v-model="date_start" class="mb-2"></b-form-datepicker>
                     </div>
                  </div>
                  <div class="form-group">
                     <div>
                        <label>End date</label>
                        <b-form-datepicker id="endDate" v-model="date_end" class="mb-2"></b-form-datepicker>
                     </div>
                  </div>
               </template>
            </b-modal>
         </div>
         <!--end modal-->
      </main>
   </body>
   <!-- Javascript --> 
   <script src="js/reading-time.js"></script>
   <script>
      // ReadingTime(numberWordsPerMinute, readigTimeLabel, minutesLabel, wordsLabel, lessThanAMinuteLabel)
      document.addEventListener('DOMContentLoaded', (event) => {
       new ReadingTime(270, 'Reading time:', 'min', 'words', 'Less than a minute');
      })
   </script>


   <script>
      var app = new Vue ({
      	el: '#app',
          data(){
      	    return {
                test_text:"Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.",
      	        date_start:"",
                date_end:"",
                test_words_count:15,
                missing_words:[],
                testFromApi:[],
                error:""
            }
          },
          mounted(){
              this.getTests()
          },
        methods:{
      	    getTests(){
                axios.post("/api-test.php", {
                    getTests: true,
                })
                .then((response) => {
                    this.testFromApi = response.data;
                })
                .catch(function (error) {
                    console.error(error);
                });
            },
      	    validateData(){
                /** ----------- reset error text ----- */
                this.error = ""
                /** ----------- validation of fields before sending to server ----- */
      	        if (this.test_text == "")
      	            this.error = "Text must be a logic paragraph"
                if (this.date_start == "")
                    this.error = "date start must be selected"
                if (this.date_end == "")
                    this.error = "date end must be selected"
                if (this.missing_words.length == 0)
                    this.error = "Must select random words"

                /** ----------- if there is a error wee dont send the data return false ----- */
                if (this.error == "")
                    return true
                else
                    return false
            },
            deleteTest(id){
                if(confirm("Are you sure to delete test number: "+ id)){
                    axios.post("/api-test.php", {
                        deleteTest: id,
                    })
                        .then((response) => {
                            console.log(response.data);
                            this.getTests()
                        })
                        .catch((error) => {
                            console.error(error);
                        });
                }
            },
            scheduleNewTest(){
      	        if (!this.validateData())
      	            return false
                axios.post("/api-test.php", {
                    test_text: this.test_text,
                    missing_words: this.missing_words,
                    test_words_count: this.test_words_count,
                    date_start: this.date_start,
                    date_end: this.date_end,
                })
                    .then((response) => {
                        console.log(response.data);
                        this.getTests()
                    })
                    .catch((error) => {
                        console.error(error);
                    });
            },
            selectRandomWords(){
                /** ----------- clean up befor re generating ----- */
                this.missing_words = []
                /** ----------- random words selection from the test_text ----- */
                words = this.test_text.split(" ");
                //for (i=0;i<words.length;i++){
                //    var random = Math.round(Math.random()*1);
                //    if (random == 1){
                //        if (words[i].length > 3 && this.missing_words.length < this.test_words_count){
                //            this.missing_words.push(words[i])
                //        }
                //    }
                //
                /** ----------- another way to randomise the selection ----- */
                for (i=0;i<words.length;i++){
                    var random = Math.floor(Math.random() * (words.length - 0) + 0);
                    if (words[random].length > 3 && this.missing_words.length < this.test_words_count){
                        this.missing_words.push({index:random,text:words[random]})
                    }
                }

            }
        }
      });
   </script>
</html>
