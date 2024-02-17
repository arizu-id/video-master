import { ReelsUpload } from './lib/browserHandler.js'

try {
  //const lokasivideo = "../../files/video/videos5029_1706749410.mp4"
  const lokasivideo = process.argv[2];
  //const caption = "halo guys"
  const caption = process.argv[3];
  //const filecookie = "../../data/fb_page/adelina.json"
  const filecookie = process.argv[4];
  //node upload.js "../../files/video/videos5029_1706749410.mp4" "halo guys" "../../data/fb_page/adelinafb.txt"
  await ReelsUpload(lokasivideo, caption,filecookie) // ==> ini function buat upload ke reels fb via puppeteer
} catch (err) {
  console.log(err)
}