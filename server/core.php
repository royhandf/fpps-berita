<?php 
    date_default_timezone_set('Asia/Jakarta');
    $key = "MIICXgIBAAKBgQCiWy9AJNetgO1ttDFPc5+TXu92BcS97yuNtfm2SeZTv+Hcl0e4
    CnTCyDdBiyKQCDeBX+9tqcCvqAze1/D7kyK/kOTwq9OJluq8gXpf4inE/k8SCjyI
    aLYKKNDsPZ8r7Pcya9hjm7yMUuapLpmZYijMrMWl97LjMcQPfMNV4VVzdwIDAQAB
    AoGBAI7NfWYCAeKOQEf58lVb8cQCAMXilQYq1Dg1E4sOvRR09gi810w9hi29RTzV
    UHU3hPq6kzH12ZGnUoq/jSr6Y9iMnb+RDuSAic7Zhxf35cy7EKfwvTw376Bgcyhz
    xPpnuqsCll/SOcvXkLNsJRq7RlTvbR6HihRyV5UfvKt+bJlhAkEA0kgaq51yIguo
    AQ2WTRlnd9xClDIFOQB7aoLBrnjEIBrunz0ZH7fEA47QfN5kiqkqt/cX9pNt3a6H
    FVrMd0R92wJBAMWnosGihHXSBq8eUPfBBxAdbBmFFMtcIZT85BfkfZgB0vAKQNX4
    La8pLzPDT9d54Eh3lxjDq7PsAKKXOXq6iZUCQQCb2DqD9BVRbCggV6yMCYboi0KA
    yK2cOGI/ZxcaMoDQdoVhWQvUuQI5zM9xq/UB2yxA2Y1V/p/PSvjsd7XPsuA/AkAk
    kXA2PPgeyD2+VnCKdeb1n0vpqMqBGUmJRAR7OyXVYrkA+hSmwaTKHGeEPyVda0oI
    fj+xMDprLkWrzyiuQSbFAkEAw/5g6bTmB2iV4PhtlMt9ci7dEbzkP1o0RVqPEJoo
    D7YEI+2NWLwRijExld/0nGFkYUxbgr15ZNH0/GqChHjYgw==";
    $issued_at = time();
    $expiration_time = $issued_at + (60*60);
    $issuer = "RestApiAuthJWT";
?>