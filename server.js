import express from "express";
import multer from "multer";
import path from "path";
import fs from "fs";

const app = express();
const upload = multer({ dest: "uploads/" }); // pasta onde salva os comprovantes

app.post("/api/confirm-payment", upload.single("receipt"), (req, res) => {
  const { orderId, buyerName, buyerEmail, notes, cart } = req.body;
  const file = req.file;

  console.log("Pedido:", orderId);
  console.log("Cliente:", buyerName, buyerEmail);
  console.log("Observações:", notes);
  console.log("Carrinho:", cart);
  console.log("Arquivo salvo em:", file.path);

  // aqui você poderia salvar no banco de dados
  res.json({ success: true, message: "Comprovante recebido com sucesso!" });
});

app.listen(3000, () => console.log("🚀 API rodando em http://localhost:3000"));
