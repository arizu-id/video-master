import { ReelsUpload } from './lib/browserHandler.js'

try {
  const lokasivideo = "../../files/video/videos5029_1706749410.mp4"
  const caption = "halo guys"
  const filecookie = "../../data/fb_page/adelina.json"
  await ReelsUpload(lokasivideo, caption,filecookie) // ==> ini function buat upload ke reels fb via puppeteer
} catch (err) {
  console.log(err)
}