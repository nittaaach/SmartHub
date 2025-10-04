@extends('user-temp.head')
@section('content')

<!-- Stats Section -->
<section id="stats" class="stats section" style="margin-top: 50px;">
  <div class="container section-title text-center" data-aos="fade-up">
    <p style="font-size: 20px; color: #000000; margin-bottom: 5px;">STATISTIKA</p>
    <p style="font-size: 14px; color: #848484; margin-bottom: 5px;">Statistik penduduk dan bangunan di RW 12 Jatiwaringin</p>
  </div><!-- End Section Title -->

  <div class="container" data-aos="fade-up" data-aos-delay="100">
    <div class="row gy-4 text-center">

      <div class="col-lg-3 col-md-6">
        <div class="stats-item d-flex justify-content-center align-items-center w-100 h-100">
          <div>
            <p style="margin: 0;">Rumah & Bangunan</p>
          </div>
        </div>
      </div><!-- End Stats Item -->

      <div class="col-lg-3 col-md-6">
        <div class="stats-item d-flex justify-content-center align-items-center w-100 h-100">
          <div>
            <p style="margin: 0;">Penduduk</p>
          </div>
        </div>
      </div><!-- End Stats Item -->

      <div class="col-lg-3 col-md-6">
        <div class="stats-item d-flex justify-content-center align-items-center w-100 h-100">
          <div>
            <p style="margin: 0;">Kelompok Usia</p>
          </div>
        </div>
      </div><!-- End Stats Item -->

      <div class="col-lg-3 col-md-6">
        <div class="stats-item d-flex justify-content-center align-items-center w-100 h-100">
          <div>
            <p style="margin: 0;">Agama</p>
          </div>
        </div>
      </div><!-- End Stats Item -->

    </div>
  </div>

  <div class="container" style="margin-top: 50px;">
    <div class="table-responsive">
      <table class="table table-striped table-hover table-bordered align-middle text-center" style="font-size: 14px; color: #333;">
        <thead class="table-light">
          <tr>
            <th>RT</th>
            <th>Jumlah</th>
            <th>Balita</th>
            <th>Anak-anak</th>
            <th>Remaja</th>
            <th>Dewasa</th>
            <th>Lansia</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>007</td>
            <td>500</td>
            <td>4</td>
            <td>34</td>
            <td>30</td>
            <td>284</td>
            <td>148</td>
          </tr>
          <tr>
            <td>003</td>
            <td>493</td>
            <td>12</td>
            <td>33</td>
            <td>29</td>
            <td>257</td>
            <td>162</td>
          </tr>
          <tr>
            <td>008</td>
            <td>396</td>
            <td>3</td>
            <td>22</td>
            <td>26</td>
            <td>215</td>
            <td>132</td>
          </tr>
          <tr>
            <td>001</td>
            <td>518</td>
            <td>1</td>
            <td>21</td>
            <td>30</td>
            <td>294</td>
            <td>168</td>
          </tr>
          <tr>
            <td>002</td>
            <td>392</td>
            <td>2</td>
            <td>19</td>
            <td>17</td>
            <td>222</td>
            <td>132</td>
          </tr>
          <tr>
            <td>006</td>
            <td>364</td>
            <td>2</td>
            <td>19</td>
            <td>19</td>
            <td>198</td>
            <td>126</td>
          </tr>
          <tr>
            <td>010</td>
            <td>369</td>
            <td>2</td>
            <td>19</td>
            <td>12</td>
            <td>205</td>
            <td>129</td>
          </tr>
          <tr>
            <td>021</td>
            <td>411</td>
            <td>1</td>
            <td>19</td>
            <td>21</td>
            <td>215</td>
            <td>152</td>
          </tr>
          <tr>
            <td>030</td>
            <td>331</td>
            <td>1</td>
            <td>18</td>
            <td>12</td>
            <td>189</td>
            <td>111</td>
          </tr>
          <tr>
            <td>023</td>
            <td>302</td>
            <td>2</td>
            <td>16</td>
            <td>15</td>
            <td>167</td>
            <td>102</td>
          </tr>
          <tr>
            <td>024</td>
            <td>200</td>
            <td>-</td>
            <td>16</td>
            <td>19</td>
            <td>105</td>
            <td>59</td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</section><!-- /Stats Section -->


@endsection

@extends('user-temp.footer')
