<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class MailTemplateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $items =
            [
                [
                    'subject' => '[Instansi/Perusahaan] Ada pesan baru (hubungi kami) di website Anda [Admin]',
                    'content' => '<table align="center" cellpadding="0" cellspacing="0" class="inner" role="presentation" style="border-collapse: collapse; box-sizing: border-box; background-color: #ffffff; margin: 0 auto; padding: 0; width: 570px; -premailer-cellpadding: 0; -premailer-cellspacing: 0; -premailer-width: 570px;" width="570">
                    <tbody>
                        <tr>
                            <td class="content-cell" style="box-sizing: border-box; padding: 35px;">
                            <h1 style="font-size: 23px; line-height: 1.5em; margin: 10px 0 30px; color: #666666;">Pesan Baru dari {name}</h1>
                
                            <p style="font-size: 14px; line-height: 1.5em; margin: 20px 0;">Pengunjung dengan nama {name} mengirim pesan melalui Form Hubungi Kami.</p>
                
                            <p style="font-size: 14px; line-height: 1.5em; margin: 20px 0;">Berikut adalah datanya :</p>
                
                            <table cellpadding="0" cellspacing="0" style="border-collapse: collapse; width: 100%; font-size: 13px; text-align: left; margin: 20px 0;">
                                <tbody>
                                    <tr>
                                        <th style="padding: 10px 12px; border: 1px solid #aaaaaa; border-right: none; border-left: none; vertical-align: top; width: 60px;">Nama</th>
                                        <td style="padding: 10px 12px; border: 1px solid #aaaaaa; border-right: none; border-left: none; vertical-align: top;">{name}</td>
                                    </tr>
                                    <tr>
                                        <th style="padding: 10px 12px; border: 1px solid #aaaaaa; border-right: none; border-left: none; vertical-align: top; width: 60px;">Email</th>
                                        <td style="padding: 10px 12px; border: 1px solid #aaaaaa; border-right: none; border-left: none; vertical-align: top;">{email}</td>
                                    </tr>
                                    <tr>
                                        <th style="padding: 10px 12px; border: 1px solid #aaaaaa; border-right: none; border-left: none; vertical-align: top; width: 60px;">No. Telp</th>
                                        <td style="padding: 10px 12px; border: 1px solid #aaaaaa; border-right: none; border-left: none; vertical-align: top;">{phone}</td>
                                    </tr>
                                    <tr>
                                        <th style="padding: 10px 12px; border: 1px solid #aaaaaa; border-right: none; border-left: none; vertical-align: top; width: 60px;">Alamat</th>
                                        <td style="padding: 10px 12px; border: 1px solid #aaaaaa; border-right: none; border-left: none; vertical-align: top;">{address}</td>
                                    </tr>
                                                        <tr>
                                        <th style="padding: 10px 12px; border: 1px solid #aaaaaa; border-right: none; border-left: none; vertical-align: top; width: 60px;">Kota</th>
                                        <td style="padding: 10px 12px; border: 1px solid #aaaaaa; border-right: none; border-left: none; vertical-align: top;">{city}</td>
                                    </tr>
                                    <tr>
                                        <th style="padding: 10px 12px; border: 1px solid #aaaaaa; border-right: none; border-left: none; vertical-align: top; width: 60px;">Provinsi</th>
                                        <td style="padding: 10px 12px; border: 1px solid #aaaaaa; border-right: none; border-left: none; vertical-align: top;">{province}</td>
                                    </tr>
                                    <tr>
                                        <th style="padding: 10px 12px; border: 1px solid #aaaaaa; border-right: none; border-left: none; vertical-align: top; width: 60px;">Pesan</th>
                                        <td style="padding: 10px 12px; border: 1px solid #aaaaaa; border-right: none; border-left: none; vertical-align: top;">{message}</td>
                                    </tr>
                                </tbody>
                            </table>
                            &nbsp;
                
                            <p style="font-size: 14px; line-height: 1.5em; margin: 20px 0;">Terimakasih</p>
                
                            <p style="font-size: 14px; line-height: 1.5em; margin: 20px 0;">Nama Perusahaan/Instansi</p>
                            </td>
                        </tr>
                    </tbody>
                </table>
                ',
                    'from_email'  => 'example@gmail.com',
                    'from_name' => 'User',
                    'template_name' => 'contact-notif-to-admin',
                    'template_description' => 'Email untuk admin, saat ada pesan baru dari form Hubungi Kami (Contact Us)',
                ],
                [
                    'subject' => '[Instansi/Perusahaan] RE: Pesan Anda telah kami balas [Hubungi Kami]',
                    'content' => '<table align="center" cellpadding="0" cellspacing="0" class="inner" role="presentation" style="border-collapse: collapse; box-sizing: border-box; background-color: #ffffff; margin: 0 auto; padding: 0; width: 570px; -premailer-cellpadding: 0; -premailer-cellspacing: 0; -premailer-width: 570px;" width="570">
                    <tbody>
                        <tr>
                            <td class="content-cell" style="box-sizing: border-box; padding: 35px;">
                            <h1 style="font-size: 23px; line-height: 1.5em; margin: 10px 0 30px; color: #666666;">Re: {subject}</h1>
                
                            <p style="font-size: 14px; line-height: 1.5em; margin: 20px 0;">Kepada Yth {name},<br />
                            Kami merespon pesan Anda.</p>
                
                            <p style="font-size: 14px; line-height: 1.5em; margin: 20px 0;">Berikut adalah pesan yang Anda kirim di Formulir Hubungi Kami :</p>
                
                            <table cellpadding="0" cellspacing="0" style="border-collapse: collapse; width: 100%; font-size: 13px; text-align: left; margin: 20px 0;">
                                <tbody>
                                    <tr>
                                        <td style="padding: 10px 12px; border: 1px solid #aaaaaa; border-right: none; border-left: none; vertical-align: top;">
                                        <table cellpadding="0" cellspacing="0" style="border-collapse: collapse; width: 100%; font-size: 13px; text-align: left; margin: 20px 0;">
                                            <tbody>
                                                <tr>
                                                    <th style="padding: 10px 12px; border: 1px solid #aaaaaa; border-right: none; border-left: none; vertical-align: top; width: 60px;">Nama</th>
                                                    <td style="padding: 10px 12px; border: 1px solid #aaaaaa; border-right: none; border-left: none; vertical-align: top;">{name}</td>
                                                </tr>
                                                <tr>
                                                    <th style="padding: 10px 12px; border: 1px solid #aaaaaa; border-right: none; border-left: none; vertical-align: top; width: 60px;">Email</th>
                                                    <td style="padding: 10px 12px; border: 1px solid #aaaaaa; border-right: none; border-left: none; vertical-align: top;">{email}</td>
                                                </tr>
                                                <tr>
                                                    <th style="padding: 10px 12px; border: 1px solid #aaaaaa; border-right: none; border-left: none; vertical-align: top; width: 60px;">No. Telp</th>
                                                    <td style="padding: 10px 12px; border: 1px solid #aaaaaa; border-right: none; border-left: none; vertical-align: top;">{phone}</td>
                                                </tr>
                                                <tr>
                                                    <th style="padding: 10px 12px; border: 1px solid #aaaaaa; border-right: none; border-left: none; vertical-align: top; width: 60px;">Alamat</th>
                                                    <td style="padding: 10px 12px; border: 1px solid #aaaaaa; border-right: none; border-left: none; vertical-align: top;">{address}</td>
                                                </tr>
                
                                                <tr>
                                                    <th style="padding: 10px 12px; border: 1px solid #aaaaaa; border-right: none; border-left: none; vertical-align: top; width: 60px;">Kota</th>
                                                    <td style="padding: 10px 12px; border: 1px solid #aaaaaa; border-right: none; border-left: none; vertical-align: top;">{city}</td>
                                                </tr>
                                                <tr>
                                                    <th style="padding: 10px 12px; border: 1px solid #aaaaaa; border-right: none; border-left: none; vertical-align: top; width: 60px;">Provinsi</th>
                                                    <td style="padding: 10px 12px; border: 1px solid #aaaaaa; border-right: none; border-left: none; vertical-align: top;">{province}</td>							</tr>
                                                <tr>
                                                    <th style="padding: 10px 12px; border: 1px solid #aaaaaa; border-right: none; border-left: none; vertical-align: top; width: 60px;">Pesan</th>
                                                    <td style="padding: 10px 12px; border: 1px solid #aaaaaa; border-right: none; border-left: none; vertical-align: top;">{message}</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="padding: 10px 12px; border: 1px solid #aaaaaa; border-right: none; border-left: none; vertical-align: top;"><strong>Respon kami</strong> :
                                        <p style="margin: 5px 0;">{replycontent}</p>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            &nbsp;
                
                            <p style="font-size: 14px; line-height: 1.5em; margin: 20px 0;">Terimakasih</p>
                
                            <p style="font-size: 14px; line-height: 1.5em; margin: 20px 0;">Nama Perusahaan/Instansi</p>
                            </td>
                        </tr>
                    </tbody>
                </table>
                ',
                    'from_email'  => 'irvan@idcodewebs.com',
                    'from_name' => 'Admin',
                    'template_name' => 'contact-reply',
                    'template_description' => 'Email untuk user, saat pesan dari form Hubungi Kami (Contact Us) sudah dibalas oleh admin',
                ],
            ];

            \DB::table('mail_templates')->insert($items);
    }
}
