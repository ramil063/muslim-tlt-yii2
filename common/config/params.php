<?php

$rootDomain = php_sapi_name() !== 'cli' ? preg_replace('#^admin.#', '', $_SERVER['SERVER_NAME']) : '';
return [
    'rootDomain' => $rootDomain,

    'adminEmail' => 'admin@example.com',
    'supportEmail' => 'support@example.com',
    'noreplyEmail' => 'ob_noreply@example.ru',
    'noreplyName' => 'МРО г Тольятти',
    'feedbackEmail' => 'ramil_063@mail.ru',

    'saltSignature' => 'FQ054KE8S6oq4V3r',

    'user.passwordResetTokenExpire' => 3600,
    'uploadDir' => realpath(__DIR__.'/../../frontend/web/upload'),
    'mosquePhotoGalleryUploadDir' => realpath(__DIR__.'/../../frontend/web/upload/mosque-photogalery'),
    'namazTimesUploadDir' => realpath(__DIR__.'/../../frontend/web/upload/namaz-times'),
    'uploadMaxFileSize' => 104857600,
    'parserUploadDir' => realpath(__DIR__.'/../../common/import/files')
];
