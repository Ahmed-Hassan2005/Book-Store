<?php

function preparePagination(array $data, string $type): void{
    if(!empty($data['data'])){

        $prepareLi = '';

        $pagesNumber = ceil($data['total'] / 10);

        $currentPage = $data['currentPage'];

        $pageIndex = $currentPage - 1;

        $NextPageNumber = ($pageIndex + 1) % $pagesNumber;
        $NextPageNumber++;
        
        $PreviousPageNumber = ($pageIndex - 1 + $pagesNumber) % $pagesNumber;
        $PreviousPageNumber++;

        $isNextPageDisabled = ($pagesNumber <= $currentPage) ? /*'disabled'*/'' : '';
        
        $isPreviousPageDisabled = ($currentPage <= 1) ? /*'disabled'*/ '' : '';

        $profileLink = route('/profile');

        for ($i = 1; $i <= $pagesNumber; $i++) {
            $isActive = ($i === $currentPage) ? 'active' : '';
            $prepareLi .= "<li class='page-item $isActive'><a class='page-link' href='{$profileLink}?$type-page={$i}'>$i</a></li>";
        }

        echo "
            <nav aria-label='Page navigation example'>
                <ul class='pagination'>
                    <li class='page-item'><a class='page-link $isPreviousPageDisabled' href='{$profileLink}?$type-page={$PreviousPageNumber}'>Previous</a></li>
                    {$prepareLi}
                    <li class='page-item'><a class='page-link $isNextPageDisabled' href='{$profileLink}?$type-page={$NextPageNumber}'>Next</a></li>
                </ul>
            </nav>
        ";

    }
    else{
        echo "";
    }
}

