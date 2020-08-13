using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;
using System.Net;
using System.Windows.Forms;
using System.Security.Principal;
using System.Security.Cryptography.X509Certificates;
using System.Security.Cryptography;
using System.Collections.Specialized;

namespace c_handler
{
    class c_api
    {
        public static string enc(string _) => Convert.ToBase64String(Encoding.UTF8.GetBytes(_));
        public static string dec(string _) => Encoding.UTF8.GetString(Convert.FromBase64String(_));

        private static string api = "http://localhost/api/";

        private static string token { get; set; }

        public static bool c_login(string c_username, string c_password, string c_hwid = "meme")
        {
            if (c_hwid == "meme") c_hwid = WindowsIdentity.GetCurrent().User.Value;

            using (WebClient sx = new WebClient { Proxy = null })
            {
                var values = new NameValueCollection
                {
                    ["username"] = enc(c_aesar.encipher(enc(c_username), 8)),
                    ["password"] = enc(c_aesar.encipher(enc(c_password), 8)),
                    ["hwid"] = enc(c_aesar.encipher(enc(c_hwid), 8))
                };

                string result = dec(c_aesar.decipher(dec(Encoding.Default.GetString(sx.UploadValues(api + "c_handle.php?m=a", values))), 8));

                switch (result)
                {
                    case "":
                        MessageBox.Show("empty_response");
                        return false;

                    case "empty_username":
                        MessageBox.Show("empty_username");
                        return false;

                    case "invalid_username":
                        MessageBox.Show("invalid_username");
                        return false;

                    case "empty_password":
                        MessageBox.Show("empty_password");
                        return false;

                    case "wrong_password":
                        MessageBox.Show("wrong_password");
                        return false;

                    case "no_sub":
                        MessageBox.Show("no_sub");
                        return false;

                    case "wrong_hwid":
                        MessageBox.Show("wrong_hwid");
                        return false;

                    case string x when x.Contains("logged_in"):
                        token = result.Split('|')[1];
                        return true;

                    default:
                        MessageBox.Show("unknown_response");
                        return false;
                }
            }
        }
        public static byte[] c_dll()
        {
            using (WebClient sx = new WebClient { Proxy = null })
            {
                var values = new NameValueCollection
                {
                    ["token"] = enc(c_aesar.encipher(enc(token), 8)),
                };

                return sx.UploadValues(api + "c_download.php", values);
            }
        }
    }
    class c_aesar
    {
        public static char cipher(char ch, int key)
        {
            if (!char.IsLetter(ch))
                return ch;

            char d = char.IsUpper(ch) ? 'A' : 'a';
            return (char)((((ch + key) - d) % 26) + d);
        }

        public static string encipher(string input, int key)
        {
            string output = string.Empty;

            foreach (char ch in input)
                output += cipher(ch, key);

            return output;
        }
        public static string decipher(string input, int key) => encipher(input, 26 - key);
    }
}
