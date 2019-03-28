<?php
return [
		//应用ID,您的APPID。
		'app_id' => "2016092500595725",

		//商户私钥，您的原始格式RSA私钥
		'merchant_private_key' => "MIIEvQIBADANBgkqhkiG9w0BAQEFAASCBKcwggSjAgEAAoIBAQCmAsQkOCdHt1vQGVmUbNaXUD5JKsRciHuif/z/6/lHXeh2TBofX5CpUJUgeEtf4/z6l6W3YRvr72L1NsTmmvlumeNkPPG33c6fC2kxj1hnUbtdY9hToToYaeSRATZUhBAgvwhJUWKP7KcOurjwYstSOYh8exRhf6vw9iy38QBUN8t9zt+q65fSyrXb1nTrycr3ZvXbVIEs223rzY4NcqYYwiMiSZv7gC2XbBACxwN/l0ibc1lAa0bXC5W1Js9MswJ0Pq1r+NkJhxopq+gBM4jQxTkVKaISmSLDsCEevctGp7nGMbxM+qkfw2AgCAvexTxP14gqnahFq/ZkY9KH9h/lAgMBAAECggEAfJ7E+N+CdS6q6IuvGGGfsZUWPLyzDTeTgAgON1vAFJflQrCcR4LoyIFqgSZshr5SERe32fI3EKTyp1uG8gnSRvmUnpG1bq4+Rlw9imuuFFlhipjCMv1r7BnJ8CR10XoV1U8yfD9w+tPPEJqQ7Dttn/r6f1+xjANYYpmaNjbfZVgJfvgl+bq8PpNXQZyfA9ODuqfYyARiFBdQWeeaj6DZTnBeWgFX8lY4pzbH6S3GuPKMinrtBnmXoowOi7KkTcYGMtDDj/tJb8P13YU8eVeVclOO1nUD363QUPB+uyn5a0YEDc/J/0yg/L1NvxxMadVz6vV4kzC+B6UbCL6hmYozXQKBgQDncdN5Qh1A6sweI7YzcN45uiG+vhFA4w8qDPFqSUVyBYPW8duEmTMMkhtNHwEbZ3lNk9HM0aEGywJk4kWRi/EWCAFG+JFEFcRKNbnWAdGzOd1pLJa1bIWqJ8DZEJ0WZC/aihLXGLIkoJ7hVFwvMCrQmT5sQddfK1Q/z/wz/VzB+wKBgQC3n7fqTLlOiYqdysQM6/myhT4+1Pf5za9/W0sJJ3APKNhVswk4bFE5aFpN0e6BYI9OfAhPrH724P+wQqwfiJ6kupcWQonnBHUJVzACJ6hRWgS+PgcXpb1Mz9yyLwq37Wy5aTczwxY2kj+hHxLr1DXI9twyJAP6WZ4JMT35LSDfnwKBgAvaDFY9SHo2i9VPRtlDgl26Zlf6K7AC8JfaqdIjhmbcWW/8Wp1jqvWN1dARMmFQ3ylV1HyEj5Zldu3rmFxnqiTSrB4SRH4UD0UtkyKeXTqsT+Y+3kjUEdQwzPNQonqvDrRGNcjF/vlZMEmhpEbWVJrx/fxVMs4wzdOmtueCpelZAoGBAK45/sByMfVB7eNQK/rywAZSBMCLRAqizdzyW10BLYNExxdxe9Mse1kUGXLzOPFLFE5sw1oNmp5W2GR+rmBxOc2lOYwmcEBha0cEkgnJZRxjZFK5+fLHELlcFNSAbBQeU+YM3hLgDSiUVYlkOYjH3oyjJkTxBVE6TQf90AaoeiOTAoGAG8EQqPD2Uu/7YbyEF6zHbj71GmpAA2sj8jXj5m2LuqeFl828QbQUJN/x80zC8WS4/oq6z0CVFpg9mA86uK55cCKsbzRFsq7nbs4lEc5vJ6fKfsNoem5rAOxk8lxOY/asBXDxUGD6dZCZtXZmnDNoXWftgnNz1nxdX5+LXrtCzCA=",

		//异步通知地址
		'notify_url' => "http://blog.com/notify",
		
		//同步跳转
		'return_url' => "http://blog.com/return",

		//编码格式
		'charset' => "UTF-8",

		//签名方式
		'sign_type'=>"RSA2",

		//支付宝网关
		'gatewayUrl' => "https://openapi.alipaydev.com/gateway.do",

		//支付宝公钥,查看地址：https://openhome.alipay.com/platform/keyManage.htm 对应APPID下的支付宝公钥。
		'alipay_public_key' => "MIGfMA0GCSqGSIb3DQEBAQUAA4GNADCBiQKBgQDIgHnOn7LLILlKETd6BFRJ0GqgS2Y3mn1wMQmyh9zEyWlz5p1zrahRahbXAfCfSqshSNfqOmAQzSHRVjCqjsAw1jyqrXaPdKBmr90DIpIxmIyKXv4GGAkPyJ/6FTFY99uhpiq0qadD/uSzQsefWo0aTvP/65zi3eof7TcZ32oWpwIDAQAB",
		//手机端标识
        "mode"=>"dnv"
	
];