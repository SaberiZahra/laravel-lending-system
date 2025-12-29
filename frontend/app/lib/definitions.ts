// This file contains type definitions for your data.
// It describes the shape of the data, and what data type each property should accept.
// For simplicity of teaching, we're manually defining these types.
// However, these types are generated automatically if you're using an ORM such as Prisma.
export type Users = {
  id: number;
  full_name: string;
  username: string;
  email: string;
  role: string;
  password_hash: string;
  address: string;
  phone: string;
  profile_image: string;
  // how much this person able to trust
  trust_number: number;
  status: string;
  created_at: number;
  updated_at: number;
  deleted_at: number;
};

export type Listings = {
  id: number;
  item_id: number;
  title: string;
  description: string;
  daily_fee: number;
  deposit_amount: number;
  available_from: number;
  available_until: number;
  created_at: number;
  updated_at: number;
  deleted_at: number;
  address: string;
  status: string;
};

export type Conversations = {
  id: number;
  created_at: number;  
};

export type Conversation_Participants = {
  conversation_id: number;
  user_id: number;
};

export type Reports = {
  id: number;
  reporter_id: number;
  to_user_id: string;
  text: string;
  statu: 'readed' | 'not read';
}

export type Categoris = {
  id: string;
  name: string;
}

export type Item = {
  id: string;
  name: string;
  count: number;
  ouner_id: string;
}

export type BorrowTable = {
  user_id: string;
  item_id: string;
  date: string;
  down_payment: true | false;
};



