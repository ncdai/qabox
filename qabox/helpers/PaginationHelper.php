<?php

class PaginationHelper
{

  public static function getCurrentUrl()
  {
    $protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https' : 'http';
    $host = $_SERVER['HTTP_HOST'];
    $uri = $_SERVER['REQUEST_URI'];
    return $protocol . '://' . $host . $uri;
  }

  public static function mergeQueryParams($url, $params)
  {
    // Parse the URL to get the existing query params
    $parsedUrl = parse_url($url);
    $existingParams = [];
    if (isset($parsedUrl['query'])) {
      parse_str($parsedUrl['query'], $existingParams);
    }

    // Merge the existing params with the new params
    $mergedParams = array_merge($existingParams, $params);

    // Rebuild the query string
    $queryString = http_build_query($mergedParams);

    // Build the new URL
    $newUrl = $parsedUrl['path'] . '?' . $queryString;
    if (isset($parsedUrl['fragment'])) {
      $newUrl .= '#' . $parsedUrl['fragment'];
    }

    return $newUrl;
  }

  public static function getPageLink($currentUrl, $page, $limit)
  {
    return PaginationHelper::mergeQueryParams($currentUrl, array('Page' => $page));
  }

  public static function getPaginationData($totalRecords, $itemPerPage, $currentPage)
  {
    $totalPages = ceil($totalRecords / $itemPerPage);
    $prevPage = ($currentPage > 1) ? $currentPage - 1 : 1;
    $nextPage = ($currentPage < $totalPages) ? $currentPage + 1 : $totalPages;

    return array(
      'totalPages' => $totalPages,
      'prevPage' => $prevPage,
      'nextPage' => $nextPage
    );
  }

  public static function buildPagination($TotalItems, $Page, $currentUrl)
  {
    $itemPerPage = ITEM_PER_PAGE;
    $paginationData = PaginationHelper::getPaginationData($TotalItems, $itemPerPage, $Page);
    $totalPages = $paginationData['totalPages'];
    $prevPage = $paginationData['prevPage'];
    $nextPage = $paginationData['nextPage'];

    $paginationHtml = '<nav>
      <ul class="pagination justify-content-center pagination-default">
        <li class="page-item">
          <a class="page-link" href="' . PaginationHelper::getPageLink($currentUrl, $prevPage, $itemPerPage) . '">
            <span>&laquo;</span>
          </a>
        </li>';

    for ($i = 1; $i <= $totalPages; $i++) {
      $activeClass = $Page == $i ? 'active' : '';
      $paginationHtml .= '<li class="page-item ' . $activeClass . '">
        <a class="page-link" href="' . PaginationHelper::getPageLink($currentUrl, $i, $itemPerPage) . '">' . $i . '</a>
      </li>';
    }

    $paginationHtml .= '<li class="page-item">
        <a class="page-link" href="' . PaginationHelper::getPageLink($currentUrl, $nextPage, $itemPerPage) . '">
          <span>&raquo;</span>
        </a>
      </li>
    </ul>
  </nav>';

    return $paginationHtml;
  }
}