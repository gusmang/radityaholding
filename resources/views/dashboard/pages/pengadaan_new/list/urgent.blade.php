<div class="col-md-12 col-12 div_display_unit" id="div_tab_urgent" style="padding:0 0 30px 0; margin: 0; overflow: hidden; display: none;">
    <div class="row" id="div-informasi-urgent"></div>
    <center>
        <div style="width: 10%; margin: auto; margin-top: 50px;" id="div-urgent-paginasi">
            <nav>
                <ul class="pagination">
                    {{-- <li class="page-item">
                        <a class="page-link" onclick="getPrevPage()" href="#" id="nprevext-urgent-page" rel="next" aria-label="Next »"><</a>
                    </li> --}}
                    <li class="page-item">
                        <a class="page-link" onclick="getPrevPage()" href="#" id="prev-urgent-page" rel="next" aria-label="Next »"><</a>
                    </li>
                        <li class="page-item" aria-current="page">
                            <select name="cmb-paging" id="cmb-paging" style="padding: 8px; border-radius: 5px; margin:0 5px;">
                                <option value="1"> 1 </option>
                            </select>
                        </li>
                        <li class="page-item">
                            <a class="page-link" onclick="getNextPage()" href="#" id="next-urgent-page" rel="next" aria-label="Next »">></a>
                        </li>
                </ul>
            </nav>
        </div>
    </center>
</div>