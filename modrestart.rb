#!/usr/bin/env ruby

require 'net/http'
require 'uri'
require 'digest/md5'
require 'open-uri'

username = "user"
password = "pwd"

postData = Net::HTTP.post_form(
    URI.parse('http://192.168.1.1/Forms/rpAuth_1'),
    {
        'LoginUserName' => username,
        'LoginPassword' => 'ZyXEL ZyWALL Series',
        'hiddenPassword' => Digest::MD5.hexdigest(password),
        'Prestige_Login' => 'Login',
        'Adv1_Language' => '00000000'

    }
)

puts postData

puts open('http://192.168.1.1/RestartDone.html').read
