<div id="Bookfilter">

    <form id="BookfilterForm" class="p-0">
        <input type="hidden" name="page" value="1" id='__7ambozo'>
        
        <div class="row">

            <div class="col-lg-6">

                <div class="item">
                    
                    <div class="input-group mb-3">
                        <label for="FilterBookTitle" class="input-group-text">@</label>
                        <input 
                            type="text" 
                            id="FilterBookTitle"
                            name="title"
                            class="form-control" 
                            placeholder="Book Title" 
                            aria-label="Book Title">
                    
                    </div>
                    
                </div>

            </div>

            <div class="col-lg-6">
                
                <div class="item">
                    
                    <div class="input-group mb-3">
                        <label for="FilterBookAuthor" class="input-group-text">@</label>
                        <input 
                            type="text" 
                            id="FilterBookAuthor"
                            name="author"
                            class="form-control" 
                            placeholder="Book Author" 
                            aria-label="Book Author">
                    
                    </div>
                    
                </div>
                    
            </div>

            <div class="col-lg-6">
                
                <div class="item">
                    
                    <div class="input-group mb-3">
                        <label for="FilterBookMinPrice" class="input-group-text">@</label>
                        <input 
                            type="text" 
                            id="FilterBookMinPrice"
                            name="minPrice"
                            class="form-control" 
                            placeholder="Book Min Price" 
                            aria-label="Book Min Price">
                    
                    </div>

                </div>
                    
            </div>

            <div class="col-lg-6">
                
                <div class="item">
                    
                    <div class="input-group mb-3">

                        <label for="FilterBookMaxPrice" class="input-group-text">@</label>
                        <input 
                            type="text" 
                            id="FilterBookMaxPrice"
                            name="maxPrice"
                            class="form-control" 
                            placeholder="Book Max Price" 
                            aria-label="Book Max Price">
                    
                    </div>

                </div>
                    
            </div>

            <div class="col-lg-6">
                
                <div class="item">

                    <div class="input-group mb-3">

                        <label for="FilterBookStock" class="input-group-text">@</label>
                        <input 
                            type="text" 
                            id="FilterBookStock"
                            name="stock"
                            class="form-control" 
                            placeholder="Book Stock" 
                            aria-label="Book Stock">
                    
                    </div>
                </div>
                    
            </div>

            <div class="col-lg-6">
                
                <div class="item">
                    
                    <div class="input-group mb-3">
                        <label for="FilterBookSortBy" class="input-group-text">@</label>

                        <select name="sortBy" id="FilterBookSortBy" class="form-select">
                            <option value="desc">Descending</option>
                            <option value="asc">Ascending</option>
                        </select>
                    
                    </div>

                </div>
                    
            </div>

        </div>

        <button class="w-100 btn btn-success mb-3">Filter</button>
            
    </form>

</div>